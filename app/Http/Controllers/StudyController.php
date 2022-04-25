<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Study;
use App\Models\Dataset;
use App\Models\Reference;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;



use Illuminate\Http\Request;



class StudyController extends Controller
{
    

   
   


     public function showall() { //LIST ALL STUDIES
$studies = Study::all();
return view ('studies.studies', ['studies' => $studies]);
    }


    public function showsubjects($id) {//SHOW ALL OF 1 SUBJECT -- FOR NAVBAR
    $category = $id;
      $studies = Study::where('subject', $id)->get();
      
      return view ('studies.categorystudies', ['studies' => $studies])->with('category', $category);

        }

    public function showdetails($id){ 
//SHOW ALL DETAILS OF A STUDY ON PAGE
//SEND ALL COMMENTS, DATASETS AND STUDY DETAILS TO THE VIEW
//TELL PAGE IF USER HAS ALREADY LIKED THE STUDY
    
      $numberoflikes= count(Like::all()->where('study_id', $id));
     $likes= Like::all()->where('user_id', Auth::user()->id)->where('study_id', $id);
     $likes= count($likes);
        $studies = Study::findOrFail($id);

        $thestudyid = $id;
      $datasets= Dataset::all()->where('study_id', $thestudyid);
    
      $comments= Comment::all()->where('study_id', $thestudyid);
    
      $references = Reference::all()->where('study_id', $id);

        return view('studies.showdetails')-> with('studies', $studies)
        ->with('datasets', $datasets)
        ->with('comments', $comments)
        ->with('references', $references)
        ->with('likes', $likes)
        ->with('numberoflikes', $numberoflikes);
       
    }



    public function manage($id){
//CODE TO MANAGE AND EDITE REFERENCES AND STUDY DETAILS
      $references = Reference::all()->where('study_id', $id);
      $studies = Study::findOrFail($id);
      $author=User::select('name')->where('email', $studies->author)->get();
      return view('studies.manage')
      ->with('studies',$studies)
      ->with('references',$references)
      ->with('author',$author);
      
      
  }
  public function manageresults($id){ // SHOW ALL DATASETS RESULTS FOR AUTHOR TO MANAGE
    $studies = Study::findOrFail($id);
    $datasets = Dataset::all()->where('study_id', $id);
    return view('studies.manageresults')->with('datasets',$datasets)->with('studies',$studies);
  }

  public function managecomments($id){ // SHOW ALL DATASETS COMMENTS FOR AUTHOR TO MANAGE
    $studies = Study::findOrFail($id);
    $comments= Comment::all()->where('study_id', $id);
    return view('studies.managecomments')->with('comments',$comments)->with('studies',$studies);
  }


    public function download($id){ //DOWNLOAD THE EPERIMENT DESIGN/STUDY FILE
        $studies = Study::findOrFail($id);
        $filepath=$studies->file;
      return response()->download(public_path('files/' .$filepath));
        
    }

    public function downloaddataset($id){ // DOWNLOAD A DATASET 
      $dataset = Dataset::findOrFail($id);

      $filepath=$dataset->file;

    return response()->download(public_path('files/' .$filepath));
      
  }


    public function removestudy($id) { // DETE A STUDY
        $study = Study::findOrFail($id);
        $study->delete();
        return view('/managemystudies');
        
    }


    public function updatestudydetails(Request $request, $id) {//FORM TO UPDATE STUDY TITLE, ABSTRACT AND CONCLUSION
      $validated = $request->validate([
        'title'=>'required|max:255',
        'conclusion'=>'required',
        'abstract'=>'required' ]);
      $study = Study::find($id);
      
      $study->title = $request->input('title');
      $study->abstract = $request->input('abstract');
      $study->conlcusion = $request->input('conclusion');

      
      $study->update();
      $link= "studies/manage/".$id;
      
      return redirect($link);
    }

    
    

    public function deletedataset($id) {
      $dataset = Dataset::findOrFail($id);
      $studyid = $dataset->study_id;
      $dataset->delete();
      return redirect('/studies/manageresults/'.$studyid);
       
  }



   
  
    public function managemystudies(){    //LIST ALL OF THE LOGGED IN USERS STUDIES IN A VIEW
      $useremail =  Auth::user()->email ;
    $studies = Study::all()->where('author', $useremail);

       return view('studies.managemystudies', ['studies' => $studies]);
        
    }
   

    public function store(Request $request) {// CREATES A STUDY
      $validated = $request->validate([
        'title'=>'required|max:255',
        'subject'=>'required',
        'abstract'=>'required',
        'author'=>'required',
        'image'=>'required',
      ]);
$study = new Study();
$study->title = $request->input('title');
$study->subject = $request->input('subject');
$study->abstract = $request->input('abstract');
$study->author = $request->input('author');
 //CODE TO UPLOAD AND STORE IMAGE && IMAGE PATH
 $imageext = $request->file('image')->Extension();
 // a NEW variable ASSIGNED which is time appended by the tittle and then the image extension file format
 $imagenew= time() . '-' . $request->input('title'). '.' . $request->file('image')->extension();
 //MOVE THE IMAGE OF THE FILE TO PUBLIC/IMAGES
 $request->file('image')->move(public_path('images'), $imagenew );
 //SAVE THE IMAGE IN THE SQL TABLE AS THE NEW FILE NAME
 $study->image= $imagenew ; 
        //CODE TO UPLOAD AND STORE FILE
        if(empty($request->input('file'))){
          $study->file="no file";
        }else{
         $filenew= time() . '-' . $request->input('title'). '.' . $request->file('file')->extension();
         $request->file('file')->move(public_path('files'), $filenew );
         $study->file = $filenew;
$study->save();
return redirect('/managemystudies');

    }

  }
public function adddataset(Request $request) {// UPLOAD RESULTS AND DATASETS
  $validated = $request->validate([
    'title'=>'required|max:255',
    'description'=>'required',
    'file'=>'required'
  ]);
  $dataset = new Dataset();
 $dataset->name= request('title');  
 $dataset->description= request('description');  
  $dataset->study_id= request('study_id');  
  $filenew= time() . '-' . request('title'). '.' . request('file')->extension();
  request('file')->move(public_path('files'), $filenew);
  $dataset->file = $filenew;
  $dataset-> save(); 


  return redirect('/studies/manageresults/'.request('study_id'));

}
public function addreference(Request $request, $id) {//ADD REFERENCES

  
  $validated = $request->validate([
    'title'=>'required|max:255',
    'type'=>'required',
    'author'=>'required' ]);
  $reference= new Reference();
  $reference->study_id = $id;
  $reference->title = $request->input('title');
  $reference->type = $request->input('type');
  $reference->author = $request->input('author');

  if(empty($request->input('doi'))){
    $reference->doi='no doi';
  }else {
  $reference->doi = $request->input('doi');}

  if(empty($request->input('url'))){
    $reference->url='no url';
  }else {
  $reference->url = $request->input('url');}

  $reference-> save();
$link= "/studies/manage/".$id;
  return redirect($link);
}
public function addcomment(Request $request, $id) {

  $validated = $request->validate([
    'comment'=>'required',
   

  ]);
  $comment= new Comment();
  $comment->study_id = $id;
  $comment->user_id = $request->input('user');
  $comment->username = $request->input('username');
  $comment->comment = $request->input('comment');
  $comment->save();
  
  return redirect('studies/'.$id);

}
public function deletecomment($id) {
  $comment = Comment::findOrFail($id);
  $studyid = $comment->study_id;
  $comment->delete();
  return redirect('/studies/managecomments/'.$studyid);
}



//function to like a study
public function like(Request $request, $id) {
 $likestatus = $request->input('likestatus');
if($likestatus == "like"){
$like= new Like();
$like->user_id = Auth::user()->id;
$like->study_id = $id;
$like->liked = 'liked';
$like->save();
return redirect('/studies/'.$id);
}
if($likestatus == "unlike"){
  $likes= Like::all()->where('user_id', Auth::user()->id)->where('study_id', $id)->first();
  $likes->delete();
  return redirect('/studies/'.$id);
}




}
}

