<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pricing.css')}}">
</head>

<body>
    <section class="pricing-table">
        <div class="container">
            <div class="block-heading">
              <h2>Select A Package</h2>
            </div>
            <div class="row justify-content-md-center">
                @forelse($data as $membership)
                <div class="col-md-5 col-lg-4">
                    <div class="item">
                        <div class="heading">
                            <h3>{{ucfirst($membership->package->title)}}</h3>
                        </div>
                        <p>{{$membership->package->description}}</p>
                        <div class="features">
                            <h4><span class="feature">Voice Type</span> : <span class="value">{{$membership->voice_type}}</span></h4>
                            <h4><span class="feature">Character Allowed</span> : <span class="value">{{$membership->characters_length}}</span></h4>
                  
                        </div>
                        <div class="price">
                            <h4>${{$membership->package->price}} /Month</h4>
                        </div>
                        <form >
                           <a class="btn btn-block btn-outline-primary" href="{{config('services.clickBank.baseLink').$membership->package->sku}}" target="_blank" id='subscribepackages' class="btn themeBtn" packageid='{{$membership->package->Id}}'>Subscribe</a>
                        </form>
                    </div>
                </div>
                @empty
                <div>
                    No,Package Found
                    <p><a href="{{route('index')}}">Go To Home</a></p>
                </div>
                @endforelse
               <!--  <div class="col-md-5 col-lg-4">
                    <div class="item">
                        <div class="ribbon">Best Value</div>
                        <div class="heading">
                            <h3>PRO</h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="features">
                            <h4><span class="feature">Full Support</span> : <span class="value">Yes</span></h4>
                            <h4><span class="feature">Duration</span> : <span class="value">60 Days</span></h4>
                            <h4><span class="feature">Storage</span> : <span class="value">50GB</span></h4>
                        </div>
                        <div class="price">
                            <h4>$50</h4>
                        </div>
                        <button class="btn btn-block btn-primary" type="submit">BUY NOW</button>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="item">
                        <div class="heading">
                            <h3>PREMIUM</h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="features">
                            <h4><span class="feature">Full Support</span> : <span class="value">Yes</span></h4>
                            <h4><span class="feature">Duration</span> : <span class="value">120 Days</span></h4>
                            <h4><span class="feature">Storage</span> : <span class="value">150GB</span></h4>
                        </div>
                        <div class="price">
                            <h4>$150</h4>
                        </div>
                        <button class="btn btn-block btn-outline-primary" type="submit">BUY NOW</button>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</body>

</html>