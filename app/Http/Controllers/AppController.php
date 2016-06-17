<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Response; 
use Illuminate\Http\Request;
use App\Http\Requests\Testapp;
use App\Model_test_app_user;
use App\Avatar;
class AppController extends Controller
{
    private $pathUpload = 'avatar/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = Model_test_app_user::all();
        return response($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $avatar = Avatar::all();
        foreach ($avatar as $key => $value) {
          $idavatar = $value->id;
        }
       
        $data = $request->only(['name', 'age', 'address']);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $idavatar.$file->getClientOriginalName();
            if (!file_exists($this->pathUpload)) {
                mkdir($this->pathUpload, 0777);
            }
            $file->move($this->pathUpload, $fileName);
            $data['photo'] = $fileName;
        }else{
             $data['photo'] = "default.jpg";
        }
        $users = new Model_test_app_user;
        $users->name=$data['name'];
        $users->address=$data['address'];
        $users->age=$data['age'];
        $users->photo=$data['photo'];
        $users->save();
         $dataavatar['id']= $idavatar+1;
        Avatar::where('id', $idavatar)->update($dataavatar);
        $response = ['success'];
        return response($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $users = Model_test_app_user::find($id);
        return json_decode($users, true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $avatar = Avatar::all();
        foreach ($avatar as $key => $value) {
          $idavatar = $value->id;
        }
       $data = $request->only(['name', 'age', 'address']);
       if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $idavatar.$file->getClientOriginalName();
            if (!file_exists($this->pathUpload)) {
                mkdir($this->pathUpload, 0777);
            }
            $file->move($this->pathUpload, $fileName);
            $data['photo'] = $fileName;
        }else{
             $data['photo'] = "default.jpg";
        }
         Model_test_app_user::where('id', $id)->update($data);
         $dataavatar['id']= $idavatar+1;
        Avatar::where('id', $idavatar)->update($dataavatar);
        $response = ['success'];
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = Model_test_app_user::find($id);
        $users->delete();
    }
}
