{!! Form::model($search, ['route' => ['tickets.search-ticket'], 'method' => 'get']) !!} 
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
            <input type="text" name="name" class="form-control" Placeholder="Customer Name" value="{{ $name }}"/>
        </div>
    </div>
    <div class="input-group pull-right">&nbsp;
        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </div>
{!! Form::close() !!}

