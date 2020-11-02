@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <a href="{{route('activity.create')}}" class="btn btn-outline-primary">Tambah Kegiatan</a>
            </div>

            <div class="card border-0 shadow">
                <div class="px-3 py-3">
                    <h4 class="text muted">Master Kegiatan</h4>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode kegiatan</th>
                                <th>Informasi</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>        
                        <tbody>
                            @foreach($activitys as $activity)
                            <tr>
                                <td><a href="{{route('activity.tampil-fromEdit','$activity->id')}}" class="btn btn-outline-primary btn-sm">{{$activity->code_activity}}</a><td>
                                <td>{{$activity->name}}</td>
                                <td>{{$activity->information}}</td>
                                <td>{{$activity->status}}</td>
                                <td>{{$activity->option}}</td>
                                <td>
                                <img src="{{asset('storage/'. $activity->images)}}" alt="" class="rounded" weight="50" height="50">
                                </td>
                                <td>
                                    
                                    <a href="http://" class="btn btn-outline-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                                @endforeach
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection