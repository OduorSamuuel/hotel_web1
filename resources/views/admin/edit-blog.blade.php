@include('admin.layout')
<div class="page-wrapper">
    <div class="content container-fluid">
    <div class="page-header">
    <div class="row align-items-center">
    <div class="col">
    <h3 class="page-title mt-5">Edit Blog</h3>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
    <form>
    <div class="row formtype">
    <div class="col-md-4">
    <div class="form-group">
    <label>Blog Name</label>
    <input class="form-control" type="text" value="John">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>File Upload</label>
    <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" id="customFile" name="filename">
    <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Blog Category</label>
    <select class="form-control" id="sel1" name="sellist1">
    <option>Select</option>
    <option>Hotel Events</option>
    <option>Rooms</option>
    <option>Vechicle</option>
    </select>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Blog Sub-category</label>
    <select class="form-control" id="sel2" name="sellist1">
    <option>Select</option>
    <option>Hotel</option>
    <option>Rooms</option>
     <option>Quad</option>
    <option>King</option>
    <option>Suite</option>
    <option>Villa</option>
    </select>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Message</label>
    <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="display-block">Blog Status</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="status" id="blog_active" value="option1" checked>
    <label class="form-check-label" for="blog_active">
    Active
    </label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="status" id="blog_inactive" value="option2">
    <label class="form-check-label" for="blog_inactive">
    Inactive
    </label>
    </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    <button type="button" class="btn btn-primary buttonedit">Save</button>
    </div>
    </div>
    
    </div>
    @include('admin.endlayout')