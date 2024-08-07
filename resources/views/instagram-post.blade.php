<!DOCTYPE html>
<html>

<head>
    <title>Post to Instagram</title>
</head>

<body>
    <h1>Post to Instagram</h1>
    <form action="{{ route('instagram.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div>
            <label for="caption">Caption:</label>
            <textarea id="caption" name="caption" rows="4" required></textarea>
        </div>
        <div>
            <button type="submit">Post to Instagram</button>
        </div>
    </form>
</body>

</html>
