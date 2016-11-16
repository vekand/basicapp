<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


/*Route::get('a-test', function() {

    $rnd = rand(1, 5); // varying number erves as a marker to show it works
    $moves= Move::take($rnd)->get();

return View::make('courses.testa', compact('top5events','rnd','moves'));
});*/


	// Authentication routes
Route::get('auth/login', [
  'uses' => 'Auth\AuthController@getLogin',
  'as' => 'login'
  ]);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout',  ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

	// Registration router
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'postregister', 'uses' => 'Auth\AuthController@postRegister']);
Route::put('auth/profregister', ['as' => 'profregister', 'uses' => 'Auth\AuthController@profRegister']);

	// Password Reset Routes
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

	// Categories routes
//	Route::resource('categories', 'CategoryController', ['except' => ['create']]);

	// Other Pages
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog']);
Route::get('blogpart/{id}', ['uses' => 'BlogController@getBlogPart', 'as' => 'blogpart']);
Route::get('popular', ['as' => 'popular', 'uses' => 'BlogController@getPopular']);
Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@getContact']);
Route::post('contact', ['as' => 'contact', 'uses' => 'PagesController@postContact']);
Route::get('about/{id}', ['as' => 'about', 'uses' => 'PagesController@getAbout']);
Route::get('/',  ['as' => 'home', 'uses' => 'PagesController@getIndex']);
Route::get('carousel',  ['as' => 'carousel', 'uses' => 'PagesController@getCarousel']);
Route::get('foto/{foto}',  ['as' => 'getfoto', 'uses' => 'PagesController@getCFoto']);
Route::get('language/{lang}','HomeController@language');

Route::get('tournamentguest', ['as' => 'tournamentguest', 'uses' => 'TournamentGuestController@index']);
Route::get('tournamentauth', ['as' => 'tournamentauth', 'uses' => 'TournamentController@index']);

Route::get('tournamentview/{tournament}', ['as' => 'tournamentview', 'uses' => 'TournamentGuestController@show']);
Route::get('register/{tournament}', ['as' => 'tournamentgetregister', 'uses' => 'TournamentGuestController@getRegister']);
Route::post('tournamentregister/{tournament}', ['as' => 'tournamentpostregister', 'uses' => 'TournamentGuestController@postRegister']);
Route::get('tournamentregistered/{tournament}', ['as' => 'tournamentgetregistered', 'uses' => 'TournamentGuestController@getRegistered']);
Route::get('chessresult/{tournament}', ['as' => 'chessresult', 'uses' => 'TournamentGuestController@chessResults']);
Route::get('chessimages/{tournament}', ['as' => 'tournamentimages', 'uses' => 'TournamentGuestController@getImages']);

Route::get('help', ['as' => 'help', 'uses' => 'TournamentGuestController@help']);
Route::get('tournament/{tournament_id}', ['as' => 'tournament.image', 'uses' => 'TournamentGuestController@getFile']);
Route::get('id/{id}/round/{round}', ['as' => 'tournaments.rounds', 'uses' => 'TournamentGuestController@getRound']);
Route::get('initial/{id}', ['as' => 'tournaments.initiallist', 'uses' => 'TournamentGuestController@getInitial']);
Route::get('final/{id}', ['as' => 'tournaments.finallist', 'uses' => 'TournamentGuestController@getFinal']);
Route::get('elo/{id}', ['as' => 'tournaments.elo', 'uses' => 'TournamentGuestController@getElo']);

//comments
Route::post('comments/{post_id}', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);

///////////////// roles /////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['roles']], function () {

/* Route::get('access', [
  'as' => 'access',
  'roles' => ['Visitor', 'Blogger', 'Referee', 'Teacher', 'Student', 'Author', 'Admin']
  ]);*/
	// Asign roles routes
 Route::get('/admin', [
  'uses' => 'AppController@getAdminPage',
  'as' => 'admin',
  'roles' => ['Admin']
  ]);
 Route::get('/adminfilter', [
  'uses' => 'AppController@getAdminPageFilter',
  'as' => 'adminfilter',
  'roles' => ['Admin']
  ]);
 Route::post('/admin/assign-roles', [
  'uses' => 'AppController@postAdminAssignRoles',
  'as' => 'admin.assign',
  'roles' => ['Admin']
  ]);

// Asign prof routes
Route::get('profu', [
  'uses' => 'AppController@getProfPage',
  'as' => 'prof',
  'roles' => ['Super']
  ]);

Route::get('/profcreate', [
  'uses' => 'AppController@createProf',
  'as' => 'profesori.create',
  'roles' => ['Super']
  ]);

Route::get('/profesoriedit/{id}', [
  'uses' => 'AppController@editProf',
  'as' => 'profesori.edit',
  'roles' => ['Super']
  ]);
Route::post('/profesoristore', [
  'uses' => 'AppController@storeProf',
  'as' => 'profesori.store',
  'roles' => ['Super']
  ]);
Route::put('/profesoriupdate/{id}', [
  'uses' => 'AppController@updateProf',
  'as' => 'profesori.update',
  'roles' => ['Super']
  ]);
// comments

 Route::get('comments/{id}/edit', ['as' => 'comments.edit', 'uses' => 'CommentsController@edit', 
  'roles' => ['Blogger', 'Author']]);
 Route::put('comments/{id}', ['as' => 'comments.update', 'uses' => 'CommentsController@update', 
  'roles' => ['Blogger', 'Author']]);
 Route::delete('comments/{id}', ['as' => 'comments.destroy', 'uses' => 'CommentsController@destroy', 
  'roles' => ['Blogger', 'Author']]);
 Route::get('comments/{id}/delete', ['as' => 'comments.delete', 'uses' => 'CommentsController@delete', 
  'roles' => ['Blogger', 'Author']]);

 Route::get('carouseledit/{carousel}', ['as' => 'carousel.edit', 'uses' => 'CarouselController@edit',
   'roles' => ['Super', 'Admin']]);    
 Route::put('carouseledit/{carousel}', ['as' => 'carousel.update', 'uses' => 'CarouselController@update',
   'roles' => ['Blogger', 'Author']]);  

 Route::post('posts.store', ['as' => 'posts.store', 'uses' => 'PostController@store',
   'roles' => ['Blogger', 'Author']]);    
 Route::get('posts.index', ['as' => 'posts.index', 'uses' => 'PostController@index',
   'roles' => ['Blogger', 'Author']]);   
 Route::get('posts/create', ['as' => 'posts.create'    , 'uses' => 'PostController@create',
   'roles' => ['Blogger', 'Author']]); 
 Route::get('posts/{posts}', ['as' => 'posts.show'  , 'uses' => 'PostController@show',
   'roles' => ['Blogger', 'Author']]); 
 Route::delete('posts/{posts}', ['as' => 'posts.destroy'   , 'uses' => 'PostController@destroy',
   'roles' => ['Blogger','Author']]); 
 Route::put('posts/{posts}', ['as' => 'posts.update'  , 'uses' => 'PostController@update',
   'roles' => ['Blogger','Author']]);   
 Route::get('posts/{posts}/edit', ['as' => 'posts.edit' , 'uses' => 'PostController@edit',
   'roles' => ['Blogger','Author']]); 

 Route::post('categories.store', ['as' => 'categories.store', 'uses' => 'CategoryController@store',
   'roles' => ['Blogger','Author']]); 
 Route::get('categories.index', ['as' => 'categories.index' , 'uses' => 'CategoryController@index',
   'roles' => ['Blogger', 'Author']]); 
 Route::delete('categories/{categories}', ['as' => 'categories.destroy' ,'uses' => 'CategoryController@destroy','roles' => ['Blogger','Author']]); 
 Route::get('categories/{categories}', ['as' => 'categories.show' , 'uses' => 'CategoryController@show',
   'roles' => ['Blogger', 'Author']]); 
 Route::put('categories/{categories}', ['as' => 'categories.update' , 'uses' => 'CategoryController@update',
   'roles' => ['Blogger','Author']]); 
 Route::get('categories/{categories}/edit', ['as' => 'categories.edit' , 'uses' => 'CategoryController@edit',
   'roles' => ['Blogger','Author']]); 


 Route::post('tags.store', ['as' => 'tags.store', 'uses' => 'TagController@store',
   'roles' => ['Blogger','Author']]); 
 Route::get('tags.index', ['as' => 'tags.index' , 'uses' => 'TagController@index',
   'roles' => ['Blogger', 'Author']]); 
 Route::delete('tags/{tags}', ['as' => 'tags.destroy' ,'uses' => 'TagController@destroy',
   'roles' => ['Blogger','Author']]); 
 Route::get('tags/{tags}', ['as' => 'tags.show' , 'uses' => 'TagController@show',
   'roles' => ['Blogger', 'Author']]); 
 Route::put('tags/{tags}', ['as' => 'tags.update' , 'uses' => 'TagController@update',
   'roles' => ['Blogger','Author']]); 
 Route::get('tags/{tags}/edit', ['as' => 'tags.edit' , 'uses' => 'TagController@edit',
   'roles' => ['Blogger','Author']]); 

 /*Route::get('excel', [
  'uses' => 'ExcelController@getUserExcel',
  'as' => 'excel',
  'roles' => ['Author']]); */
 Route::get('pdf', [
  'uses' => 'PDFController@getPDF',
  'as' => 'pdf',
  'roles' => ['Author']]); 


 Route::post('tournaments.store', ['as' => 'tournaments.store', 'uses' => 'TournamentController@store',
   'roles' => ['Referee','Author']]); 
 Route::get('tournaments.index', ['as' => 'tournaments.index' , 'uses' => 'TournamentController@index',
   'roles' => ['Visitor', 'Blogger', 'Referee', 'Teacher', 'Student', 'Author']]); 
 Route::get('tournaments/create', ['as' => 'tournaments.create'    , 'uses' => 'TournamentController@create',
   'roles' => ['Referee','Author']]); 
 Route::delete('tournaments/{tournament}', ['as' => 'tournaments.destroy' ,'uses' => 'TournamentController@destroy',
   'roles' => ['Referee','Author']]); 
 Route::get('tournamentsshow/{tournament}', ['as' => 'tournaments.show' , 'uses' => 'TournamentController@show',
   'roles' => ['Visitor', 'Blogger', 'Referee', 'Teacher', 'Student', 'Author']]); 
 Route::put('tournamentsput/{tournament}', ['as' => 'tournaments.update' , 'uses' => 'TournamentController@update',
   'roles' => ['Referee','Author']]); 
 Route::get('tournaments/{tournament}/edit', ['as' => 'tournaments.edit' , 'uses' => 'TournamentController@edit',
   'roles' => ['Referee','Author']]); 

 Route::get('tournamentget/{id}/round/{round}', ['as' => 'tournaments.getrounds', 'uses' => 'TournamentController@getRound',
   'roles' => ['Referee','Author']]); 
 Route::post('tournamentpost/id/{id}/round/{round}', ['as' => 'tournaments.postrounds', 'uses' => 'TournamentController@postRound',
  'roles' => ['Referee','Author']]); 

 Route::get('tournamentinitial/{id}', ['as' => 'tournaments.getinitial', 'uses' => 'TournamentController@getInitial',
  'roles' => ['Referee','Author']]); 
 Route::post('tournamentinitial/{id}', ['as' => 'tournaments.postinitial', 'uses' => 'TournamentController@postInitial',
  'roles' => ['Referee','Author']]); 

 Route::get('tournamentfinal/{id}', ['as' => 'tournaments.getfinal', 'uses' => 'TournamentController@getFinal','roles' => ['Referee','Author']]); 
 Route::post('tournamentfinal/{id}', ['as' => 'tournaments.postfinal', 'uses' => 'TournamentController@postFinal','roles' => ['Referee','Author']]); 

 Route::get('tournamentelo/{id}', ['as' => 'tournaments.getelo', 'uses' => 'TournamentController@getElo',
  'roles' => ['Referee','Author']]); 
 Route::post('tournamentelo/{id}', ['as' => 'tournaments.postelo', 'uses' => 'TournamentController@postElo',
  'roles' => ['Referee','Author']]); 

 Route::get('tournamentimages/{id}', ['as' => 'tournaments.getimages', 'uses' => 'TournamentController@getImages',
  'roles' => ['Referee','Author']]); 
 Route::post('tournamentimages/{id}', ['as' => 'tournaments.postimages', 'uses' => 'TournamentController@postImages',
  'roles' => ['Referee','Author']]); 
 Route::delete('tournamentsplayer/{player}/tournament/{tournament}', ['as' => 'tournaments.deleteplayer' ,'uses' => 'TournamentController@destroyPlayer',
   'roles' => ['Referee','Author']]); 

////////////////////// courses    ///////////////////////////////////////////////////////

 Route::post('courses.store', ['as' => 'courses.store', 'uses' => 'CourseController@store',
   'roles' => ['Teacher', 'Author']]); 
 Route::get('courses.index', ['as' => 'courses.index' , 'uses' => 'CourseController@index',
   'roles' => ['Teacher', 'Student', 'Author']]); 
 Route::get('courses/create', ['as' => 'courses.create'    , 'uses' => 'CourseController@create',
   'roles' => ['Teacher','Author']]); 
 Route::get('courses/access/{id}', ['as' => 'courses.access'    , 'uses' => 'CourseController@access',
   'roles' => ['Teacher','Author']]); 

 Route::post('courses/assign/{id}', [
  'uses' => 'CourseController@assignAccess',
  'as' => 'courses.assign',
  'roles' => ['Teacher','Author']]); 

 Route::delete('courses/{course}', ['as' => 'courses.destroy' ,'uses' => 'CourseController@destroy',
   'roles' => ['Teacher','Author']]); 
 Route::get('courses/{course}', ['as' => 'courses.show' , 'uses' => 'CourseController@show',
   'roles' => ['Teacher', 'Author']]); 
 Route::put('courses/{course}', ['as' => 'courses.update' , 'uses' => 'CourseController@update',
   'roles' => ['Teacher','Author']]); 

 Route::get('courses/{course}/diagrams', ['as' => 'courses.diagrams' , 'uses' => 'CourseController@getDiagrams',
   'roles' => ['Teacher', 'Student', 'Author']]); 

 Route::get('courses/{course}/newdiagram', ['as' => 'courses.newdiagr' , 'uses' => 'CourseController@newDiagram',
   'roles' => ['Teacher','Author']]); 

 Route::get('courses/{course}/homework', ['as' => 'courses.homework' , 'uses' => 'CourseController@homework',
   'roles' => ['Teacher', 'Student', 'Author']]); 
Route::get('courses/{course}/homeworkall', ['as' => 'courses.homeworkall' , 'uses' => 'CourseController@homeworkall',
   'roles' => ['Teacher', 'Student', 'Author']]); 

 Route::get('courses/{course}/solved', ['as' => 'courses.solved' , 'uses' => 'CourseController@solved',
   'roles' => ['Teacher', 'Student', 'Author']]);

 Route::get('courses/{course}/editor', ['as' => 'courses.editor' , 'uses' => 'CourseController@editor',
   'roles' => ['Teacher', 'Author']]);  

 Route::post('courses/{course}/savehtml', ['as' => 'courses.savehtml' , 'uses' => 'CourseController@saveHTML',
   'roles' => ['Teacher', 'Author']]); 

 Route::get('courses/{course}/viewhtml', ['as' => 'courses.viewhtml' , 'uses' => 'CourseController@getFileHTML',
   'roles' => ['Teacher', 'Student', 'Author']]); 

 Route::post('courses/{course_id}/moves', ['as' => 'courses.moves' , 'uses' => 'CourseController@postMoves',
   'roles' => ['Teacher', 'Author']]);   

 Route::get('courses/{diagram_id}/diagramhomework', ['as' => 'courses.diagramhomework' , 'uses' => 'CourseController@getDiagramHomework',
   'roles' => ['Teacher', 'Student', 'Author']]);     

 Route::get('courses/{course}/edit', ['as' => 'courses.edit' , 'uses' => 'CourseController@edit',
   'roles' => ['Teacher','Author']]); 

Route::post('/hWork', ['as' => 'hWork' , 'uses' => 'CourseController@gethWork',
 'roles' => ['Teacher', 'Student', 'Author']]);  
Route::post('/solve', ['as' => 'solve' , 'uses' => 'CourseController@solveDiagram',
   'roles' => ['Teacher', 'Student', 'Author']]); 
Route::post('/pgn', ['as' => 'pgn' , 'uses' => 'CourseController@savePgn',
   'roles' => ['Teacher', 'Author']]); 
Route::get('course/{course_id}/image', ['as' => 'course.image', 'uses' => 'CourseController@getFilePDF',
    'roles' => ['Teacher', 'Student', 'Author']]); 
Route::get('/solveddiagrams/{course_id}', ['as' => 'courses.solveddiagrams' , 'uses' => 'CourseController@getSolvedDiagrams',
   'roles' => ['Teacher', 'Author', 'Student']]); 
Route::get('gameeditor/{course}', ['as' => 'gameeditor', 'uses' => 'CourseController@gameEditor',
   'roles' => ['Teacher', 'Student', 'Author']]); 
Route::get('gameplay/{course}', ['as' => 'gameplay', 'uses' => 'CourseController@gamePlay',
   'roles' => ['Teacher', 'Student', 'Author']]); 

// about
Route::get('/aboutedit/{about_id}', ['as' => 'about.edit' , 'uses' => 'PagesController@editAbout',
   'roles' => ['Author', 'Admin', 'Super']]); 
Route::put('/aboutupdate/{about_id}', ['as' => 'about.update' , 'uses' => 'PagesController@updateAbout',
   'roles' => ['Author', 'Admin', 'Super']]); 
///////////////

// home
Route::get('/home/{home_id}', ['as' => 'home.edit' , 'uses' => 'PagesController@editHome',
   'roles' => ['Admin', 'Super']]); 
Route::put('/home/{home_id}/update', ['as' => 'home.update' , 'uses' => 'PagesController@updateHome',
   'roles' => ['Admin', 'Super']]); 
///////////////

// pgn
Route::get('/pgnviewer/{course_id}', ['as' => 'pgnviewer' , 'uses' => 'CourseController@pgnViewer',
   'roles' => ['Teacher', 'Author', 'Student']]);
Route::get('/pgnedit/{course_id}', ['as' => 'pgnedit' , 'uses' => 'CourseController@pgnEdit',
   'roles' => ['Teacher', 'Author']]);  
Route::get('/pgneditor/{course_id}', ['as' => 'pgneditor' , 'uses' => 'CourseController@pgnEditor',
   'roles' => ['Teacher', 'Author']]);  
Route::get('/pgnretrieve/{course_id}', ['as' => 'pgnretrieve' , 'uses' => 'CourseController@pgnRetrieve',
   'roles' => ['Teacher', 'Author', 'Student']]);    
Route::get('/numaicurs/{course_id}', ['as' => 'numaicurs' , 'uses' => 'CourseController@numaicurs',
   'roles' => ['Teacher', 'Author', 'Student']]);            
Route::post('/pgnpost/{course_id}', ['as' => 'pgnpost' , 'uses' => 'CourseController@pgnPost',
   'roles' => ['Teacher', 'Author']]); 

});


