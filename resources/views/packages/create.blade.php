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
    <form style="margin:10px" class="col-sm-8" action="{{route('packages.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Package Name</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Package Name">
        </div>
        <div class="form-group">
            <label for="number_of_sessions">No. Of sessions</label>
            <input type="number" name="number_of_sessions" class="form-control">
        </div>
        <div class="form-group">
            <label for="package_price">Package Price (usd) </label>
            <input class="form-control" type="number" name="package_price" id="package_price">
        </div>

        <div class="form-group">
            <a class="btn btn-success" id="session_toggle" data-toggle="modal" data-target="#SessionModal">Add Session</a>
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
    <div class="modal fade" id="SessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add Sessions To Your Package</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="session_container">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" id="add-session" class="btn btn-success">Add More Session</button>
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
document.getElementById("add-session").addEventListener("click", ()=>{
    const session_div = drawElement("div");
    appendElement(document.getElementById('session_container'), session_div);
    // insertAfter(session_div, document.getElementById("first-session"));
    session_div.innerHTML = `<div class="form-group">
            <label for="session_name">Session Name</label>
            <select class="form-control" name="session_id[]">
                @foreach($sessions as $session)
                    <option value="{{$session->id}}">{{$session->name}}</option>
              @endforeach
            </select>
            </div>
            <div  class="form-group">
                <label for="session_amount">Session amount </label>
                <input class="form-control" type="number" name="session_amount[]" id="session_amount[]">
            </div>`;

});

</script>
@endsection