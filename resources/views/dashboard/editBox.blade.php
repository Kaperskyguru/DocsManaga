<form action="{{route('updateDocument', ['id' => $document->id])}}" id="addUser" method="post">
    @csrf @method('PATCH')
    <div class="form-group">
        <label for="title" class=" form-control-label">Document title</label>
        <input type="text" name="title" id="title" value="{{$document->title}}" placeholder="Enter your title" class="form-control"
        />
    </div>

    <div class="form-group">
        <label for="desc" class=" form-control-label">Description</label>
        <textarea id="desc" name="description" class="form-control">{{$document->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="category" class=" form-control-label">Category</label>
        <input type="text" name="category" placeholder="Enter category here" list="category" class="form-control" />
        <datalist id="category">
            <option value="Unknown">
            <option value="Auto & Vehicles">
            <option value="Business & Marketing">
            <option value="Creative">
            <option value="Film & Music">
            <option value="Fun & Entertainment">
            <option value="Hobby & Home">
            <option value="Knowledge & Resources">
            <option value="Nature & Animals">
            <option value="News & Politics">
            <option value="Nonprofits & Activism">
            <option value="Religion & Philosophy">
            <option value="Sports">
            <option value="Technology & Internet">
            <option value="Travel & Events">
            <option value="Weird & Bizarre">
        </datalist>
    </div>
    <div class="form-group">
        <label for="access" class=" form-control-label">Access</label>
        <select name="access" id="access" class="form-control">
            <option selected disabled value="{{$document->access}}">{{$document->access == 1 ? 'Public' : 'Private'}}</option>
                <option value="1">Public</option>
                <option value="2">Private</option>
            </select>
    </div>
</form>