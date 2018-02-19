<div class="card mt-8 card-outline-secondary">

    <div class="card-header">
        <h3 class="p-2">{{$title}}:</h3>
    </div>

    <div class="card-body">
        @if(isset($info))
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$info}}</li>
            </ul>
        @else
            {{$slot}}
        @endif

    </div>
    <div class="card-footer">
        <a href="/CLC/profile/edit/{{$category}}" title="Edit {{$title}}"><span class="fa fa-pencil-square-o"
                                                                                style="font-size: 20px;"></span></a>
    </div>
</div>