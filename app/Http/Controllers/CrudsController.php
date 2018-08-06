<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CrudsController extends Controller {
  public function create(Request $request) {
    $crud = new Crud();
    $crud->name = $request->input('name');
    $crud->save();

    return response($crud->jsonSerialize(), Response::HTTP_CREATED);
  }

  public function index() {
    return response(Crud::all()->jsonSerialize(), Response::HTTP_OK);
  }

  public function update(Request $request, $id) {
    $crud = Crud::findOrFail($id);
    $crud->name = $request->name;
    $crud->save();

    return response(null, Response::HTTP_OK);
  }

  public function destroy($id) {
    Crud::destroy($id);

    return response(null, Response::HTTP_OK);
  }
}
