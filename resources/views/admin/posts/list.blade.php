@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Posts</h1>
                </div>
            </div>
            @include('admin.message')
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="user-data">
                <div class="text-right">
                    <a href="{{ route('create.post') }}" class="btn btn-primary">Create Posts</a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($posts->isNotEmpty())
                                <?php $i = ($posts->currentPage() - 1) * $posts->perPage();
                                $i = $i + 1;
                                ?>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $post->heading }}</td>
                                        @if ($post->status == 1)
                                            <td>
                                                <a href="{{ route('post.status.toggle', $post->id) }}"
                                                    class="badge badge-success">
                                                    Published
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('post.status.toggle', $post->id) }}"
                                                    class="badge badge-danger">
                                                    Unpublished
                                                </a>
                                            </td>
                                        @endif

                                        <td>
                                            <a href="{{route('edit.post',encrypt($post->id))}}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#" onclick="deletePost({{$post->id}})" class="text-danger w-4 h-4 mr-1">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No post found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('custom')
    <script>
        function deletePost(id) {
            if (confirm('Do you really want to delete this ?')) {
                $.ajax({
                    url: `{{ url('/admin/delete-post') }}/${id}`,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = "{{ route('admin.posts') }}"
                        }
                    }
                });
            }
        }
    </script> 
@endsection
