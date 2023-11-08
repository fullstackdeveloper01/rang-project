<section class="section-profile-cover section-shaped my-0 d-none d-md-none d-lg-block d-lx-block">
    <div class="overlay"></div>
    <div class="row">
        <!--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-7"></div>-->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 my-5">
            <!-- Circles background -->
            <img class="bg-image" src="{{ config('global.search') }}" style="width: 100%;">
        </div>
    </div>
</section>
<section class="section">
    <div class="container mt--450">
        <h2 class="text-center text-dark header_title text-shadow">Fresh, high-quality content for every</h2>
        <h2 class="text-center text-dark header_title dynamic-text text-shadow" data-text="Creative.......">Creative.......</h2> 
        <p class="text-center text-dark header_subtitle text-shadow">Access all the images, videos, music, and tools you need to turn ideas into achievements.</p>
        <!--<h1><?php echo config('global.header_title') ?></h1>
            <p><?php echo config('global.header_subtitle') ?></p>-->
        <div class="search-holder-wrapper">
            <div class="row">
                <div class="col-md-10">
                    <form>
                        <div class="form-group mb-0">
                            <div class="input-group mb-0">
                                <!--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-basket"></i></span>
                                </div>-->
                                <input name="q" class="form-control lg" value="{{ request()->get('q') }}" placeholder="{{ __ ('Start your search here...') }}" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-theme w-100">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-space-between mt-4">
                    <button class="btn btn-outline-theme">Flowers</button>
                    <button class="btn btn-outline-theme">Strips</button>
                    <button class="btn btn-outline-theme">Solids</button>
                    <button class="btn btn-outline-theme">Checks</button>
                    <button class="btn btn-outline-theme">Dots</button>
                    <button class="btn btn-outline-theme">Geometry</button>
                    <button class="btn btn-outline-theme">Flower</button>
                    <button class="btn btn-outline-theme">Flowers</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <a href="javascript:void(0);" class="text-dark px-2 text-shadow">Thousands of design</a>
                    <a href="javascript:void(0);" class="text-dark px-2">|</a>
                    <a href="javascript:void(0);" class="text-dark px-2 text-shadow">Access on your fingertips</a>
                    <a href="javascript:void(0);" class="text-dark px-2">|</a>
                    <a href="javascript:void(0);" class="text-dark px-2 text-shadow">Instant Results</a>
                    <a href="javascript:void(0);" class="text-dark px-2">|</a>
                    <a href="javascript:void(0);" class="text-dark px-2 text-shadow">Redefining Design</a>
                </div>
            </div>
        </div> 
    </div>
</section>
