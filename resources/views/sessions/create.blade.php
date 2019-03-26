@extends('layouts.base')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger col-sm-8" style="margin: 4px;">
        <ul style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form style="margin:10px" class="col-sm-8" action="{{route('sessions.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Session Name</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Session Name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="number_of_sessions">Day</label>
        <input type="date" name="day" class="form-control" value="{{old('day')}}">
        </div>
        <div class="form-group">
            <label for="start_at">Starts At</label>
            <input class="form-control" type="time" name="start_at" id="start_at" value="{{old('start_at')}}">
        </div>
        <div class="form-group">
            <label for="finish_at">Finishes At</label>
            <input class="form-control" type="time" name="finish_at" id="finish_at" value="{{old('finish_at')}}">
        </div>
        <div class="form-group">
            <label for="price">Price (usd) </label>
            <input class="form-control" type="number" name="price" id="price" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <a class="btn btn-success" id="coach_toggle" data-toggle="modal" data-target="#CoachModal">Add Coaches To Your Session</a>
        </div>
        <div  class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>

    <button type="submit" class="btn btn-primary">Create</button>
    {{-- Modal --}}
    <div class="modal fade" id="CoachModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add Coaches To Your session</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="coach_container">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" id="add-coach" class="btn btn-success">Add More Coaches</button>
                        <button type="button" row_delete="" id="delete_item"  class="btn btn-primary" data-dismiss="modal">Done</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Dismiss</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </form>
    
@endsection
@section('extra_scripts')
<script>
const drawElement = (tagname, attributes = {}, text) => {
    const element = document.createElement(tagname);
    for (let attr in attributes) {
        element.setAttribute(attr, attributes[attr]);
    }
    if (text) {
        element.appendChild(document.createTextNode(text));
    }
    return element;
}
const appendElement = (parent, ...children) => {
    for (let child of children) {
        parent.appendChild(child);
    }
}
const appendBodySceleton = (...children) => {
        for (let i = (children.length - 1); i >= 0; i--) {
            document.body.insertBefore(children[i], document.body.firstChild);
        }
}
const insertAfter = (newNode, referenceNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
document.getElementById("add-coach").addEventListener("click", ()=>{
    const coach_div = drawElement("div");
    appendElement(document.getElementById('coach_container'), coach_div);
    // insertAfter(coach_div, document.getElementById("first-coach"));
    coach_div.innerHTML = `<div class="form-group">
            <label for="coach">Coach Name</label>
            <select class="form-control" name="coach[]">
                @foreach($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
              @endforeach
            </select>
            </div>`;

});

</script>
@endsection