<li>
    <div style='margin:10px' class="card">
        <h5 style="color: black" class="card-header">{{$package->title}}</h5>
        <div class="card-body">
            <p style="color: black" class="card-text">{{$package->description}}</p>
            <p>
                <h5 style="color: black; float: right" class="card-title">${{$package->price}} /Month</h5></p>
            <!-- <a href='{{ route("UpdatePackage")}}/{{$package->id}}' class="btn themeBtn" id="updatepackage" packageID="{{$package->id}}">Update</a> -->
            <a href='#' class="btn themeBtn" id="deletepackage" packageID="{{$package->id}}">Delete</a>
        </div>
    </div>
</li>