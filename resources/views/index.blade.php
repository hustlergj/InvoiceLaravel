<!doctype html>
@extends('layouts.master')

@section('content')
<form method="post" action="<?= URL::to('search') ?>">
    {{ csrf_field()}}
    <div class="field is-grouped">
        <p class="control">
            <input  class="input is-primary" type="text" name="inv_search" placeholder="Invoice Search">
        </p>  

        <button name="search" id="search" class="button is-primary" title="Search">Search</button> &nbsp;

        <a href={{URL::to('/add')}} type="button" class="button is-primary" title="Add new invoice"> +Add Invoice</a> 

    </div>
</form>

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
                @foreach($invoice as $inv)
                    <tr>
                        <td><a href={{url('/edit/'.$inv->id)}}>{{ $inv->inv_name }}</a></td>
                        <td>{{ $inv->inv_item }}</td>
                        <td>{{ $inv->total }}</td>
                        <form method="post" action="<?= URL::to('delete/'.$inv->id) ?>">
                        {{ csrf_field()}}
                        {{ method_field('DELETE') }}
                        <td><a  type="button" class="button is-primary" href={{URL::to('/pdf/'.$inv->id)}}>PDF</a> <button name="delete" id="delete" class="button is-primary">Remove</button></td>                        
                        </form>
                    </tr>
                @endforeach
          </tbody>
    </table>

     <div style="width:100px; margin-left:1200px;">
          {{ $invoice->links() }}
     </div>
@endsection