@extends('Qcalendar::layout')

@section('content')
<section class="content">
  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Новое мероприятие</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('events.add.post') }}" method="post">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Название мероприятия</label>
                  <input name="name" type="text" class="form-control" placeholder="Название мероприятия">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Время начала мероприятия</label>
                  <input name="start_time" type="text" class="form-control" id="inputDateRange" placeholder="Время начала мероприятия">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Время конца мероприятия</label>
                  <input name="end_time" type="text" class="form-control" id="inputDateRange" placeholder="Время конца мероприятия">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</section>

@endsection
