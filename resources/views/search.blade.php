<!doctype html>
@extends('layouts.master')

@section('content')

<h1><b>Search Invoice List</b></h1>
  <table class="table is-striped">

        <thead>
          <tr>
            <th>Invoice name</th>
            <th># of Items</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
              @foreach($result as $res)
                  <tr>
                      <td><a href={{url('/edit/'.$res->id)}}>{{ $res->inv_name }}</a></td>
                      <td>{{ $res->inv_item }}</td>
                      <td>{{ $res->total }}</td>
                      <form method="post" action="<?= URL::to('/delsearch/'.$res->id) ?>">
                        {{ csrf_field()}}
                        {{ method_field('DELETE') }}
                        <td><a  type="button" class="button is-primary" href={{URL::to('/pdf/'.$res->id)}}>PDF</a> <button name="delete" id="delete" class="button is-primary">Remove</button></td>                        
                      </form>
                      
                  </tr>
              @endforeach
        </tbody>
  </table>
  <a href={{URL::to('/')}} type="button" class="button is-primary">Back</a> 
@endsection