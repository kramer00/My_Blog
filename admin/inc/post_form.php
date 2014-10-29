
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" id="body"></textarea>
            </div>
            <div class="form-group">
            	<label for="photo">add file</label>
            	<input type="file" name="photo" id="photo">
            </div>
            <button type="submit" class="btn btn-info">
                Post
            </button>
        </form>