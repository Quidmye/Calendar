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
            <form class="ajaxForm" enctype="multipart/form-data" role="form" action="{{ route('events.add.post') }}" method="post">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="event_name">Название мероприятия</label>
                  <input value="{{ $event->name }}" id="event_name" name="name" type="text" class="form-control" placeholder="Название мероприятия">
                </div>
                <div class="form-group">
                  <label for="start_time">Время начала мероприятия</label>
                  <input value="{{ $event->start_at->format('d.m.Y H:i') }}" name="start_time" type="text" class="form-control eventTimePicker" id="start_time" placeholder="Время начала мероприятия">
                </div>
                <div class="form-group">
                  <label for="end_time">Время конца мероприятия</label>
                  <input value="{{ $event->end_at->format('d.m.Y H:i') }}" type="text" class="form-control eventTimePicker" id="end_time" placeholder="Время конца мероприятия">
                </div>
                <div class="form-group">
                  <label for="reminder_time">Напоминание</label>
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input @if($event->reminder_at) checked="checked" @endif name="reminder" type="checkbox">
                        </span>
                    <input @if($event->reminder_at) value="{{ $event->reminder_at->format('d.m.Y H:i') }}" @endif name="reminder_time" type="text" class="form-control eventTimePicker">
                  <!-- /input-group -->
                </div>
              </div>
                <div class="form-group">
                  <label for="description">Описание мероприятия</label>
                  <textarea name="description" class="form-control" id="description" rows="3" placeholder="Описание мероприятия">{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                  @foreach ($event->files()->get() as $file)
                  <blockquote>
                  <a target="_blank" href="{{ \Storage::url($file->path) }}"<p class="filename">
                    {{ basename($file->path) }}
                  </p>

                  <div class="pull-right">
                    <a href="{{ route('events.deletefile', $file) }}" class="btn btn-warning btn-sm btn-flat">Удалить</a>
                  </div>
                </blockquote><br />

                  @endforeach
                  <label for="EventFiles">Дополнительные файлы (изображения, аудио)</label>
                  <input name="event_files[]" multiple="multiple" type="file" id="EventFiles">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</section>

@endsection
