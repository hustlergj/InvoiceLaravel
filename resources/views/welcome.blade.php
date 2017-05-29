<!doctype html>
@extends('layouts.master')

@section('content')
<form>
    <div class="field is-grouped">
        <p class="control">
            <input  class="input is-primary" type="text" placeholder="Invoice">
        </p>  
       
        <button name="search" id="search" class="button is-primary">Search</button> &nbsp;

        <button name="add" id="add" class="button is-primary"><a href={{url('/add')}}>+Add Invoice</button> 
    </div>
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
        
      </tbody>
    </table>
</form>

@endsection
    
