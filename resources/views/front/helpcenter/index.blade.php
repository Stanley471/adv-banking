@extends('front.menu')
<meta name="description" content="{{$set->site_name}} Help Center" />
@section('css')

@stop
@section('content')
<section class="position-relative py-lg-5 pt-5" style="background-image: url({{asset('asset/images/auth.svg')}});" data-jarallax data-img-position="0% 100%" data-speed="0.5">
    <div class="container position-relative zindex-2 pt-5 pb-2 pb-md-0 py-6">
        <div class="row justify-content-center pt-3 mt-3">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 text-center">
                <h1 class="mb-4">{{__('How can we help?')}}</h1>
                <p class="fs-lg pb-3 mb-3">{{__('Get quick answers to your questions about '.$set->site_name)}}</p>
                <form class="rounded shadow mt-n6 mb-4" action="{{route('help.search')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border-0">
                            <i class="fe fe-search"></i>
                        </span>
                        <input value="" name="term" id="term" class="form-control border-0 px-1" type="text" aria-label="Search for your issue..." placeholder="Search for your issue..." required>
                        <span class="input-group-text border-0 py-0 ps-1 pe-3">
                            <button class="btn btn-sm btn-info" type="submit">
                                Search
                            </button>
                        </span>
                    </div>
                    @if ($errors->has('term'))
                    <span class="font-size-1 text-danger">{{$errors->first('term')}}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
<section class="container py-3 my-2 my-md-4 my-lg-5">
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center mb-6 mt-6">
                <div class="col-12 col-md-10 col-lg-10 text-center">
                    <h2 class="h1 text-center pt-1 pt-xl-2 mb-4">{{__('Popular articles')}}</h2>
                    <span class="text-dark text-uppercase">{{__('You are')}}: </span> @foreach(getPopularHelpCenter(3) as $val) <span class="badge bg-secondary rounded-pill me-2 mb-3 cursor-pointer" data-href="{{route('help.article', ['article' => $val->slug])}}">{{$val->question}}</span> @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container py-5 my-2 my-md-4 my-lg-5">
    <h2 class="h1 text-center pt-1 pt-xl-2 mb-5">{{__('Browse by topic')}}</h2>
    <div class="row g-4 pb-xl-3">
        @foreach(getHelpCenterTopics() as $val)
        <div class="col-12 col-md-6 col-lg-3 text-center">
            <div class="card mb-6 mb-md-8 cursor-pointer" data-href="{{route('help.topic', ['topic' => $val->slug])}}">
                <span class="bg-gradient-primary position-absolute top-0 start-0 w-100 h-100 opacity-10 d-none d-md-block rounded-4"></span>
                <div class="card-body text-center">
                    <div class="card d-table border-0 rounded-circle shadow-sm p-3 mx-auto mb-4">
                        <i class="fa-thin fa-{{$val->icon}} fs-2 text-dark"></i>
                    </div>
                    <h3 class="h5 mb-3 mb-lg-0">{{$val->name}}</h3>
                    <p class="text-dark fs-sm mb-5">{{$val->description}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@include('partials.livechat')
@stop
@section('script')
<script src="{{asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script>
    $('div[data-href]').on("click", function() {
        window.location.href = $(this).data('href');
    });
    $('span[data-href]').on("click", function() {
        window.location.href = $(this).data('href');
    });
</script>
@endsection