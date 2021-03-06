@extends('frontEnd.layouts.master')
@section('title','Our Service - FlingEx')
@section('content')
<div class="quicktech-all-page-header-bg">
         <div class="container">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                    
                 </ol>
             </nav>
         </div>
     </div>
     <!-- Hero Area End -->
   <!-- About Section start -->
     <div class="about-area section-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-12 col-xs-12 info">
                     <div class="about-wrapper wow fadeInLeft" data-wow-delay="0.3s">
                         <div>
                             <div class="site-heading">
                                 <p class="mb-3">Service</p>
                                 <h2 class="section-title">{{$servicedetails->title}}</h2>
                             </div>
                             <div class="content">
                                 <p>
                                    {!! $servicedetails->text !!}
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-12 col-xs-12 wow fadeInRight" data-wow-delay="0.3s">
                     <img class="img-fluid" src="{{asset($servicedetails->image)}}" alt="">
                 </div>
             </div>
         </div>
     </div>
     <!-- Call To Action Section Start -->
     <section id="cta" class="section-padding bg-lightblue">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8 col-md-8 col-xs-12 wow fadeInLeft" data-wow-delay="0.3s">
                     <div class="cta-text">
                         <!--<h4>Get free Register Now</h4>-->
                         <h5 class="mb-0 heading-font">Struggling on sending parcels efficiently? Give a try with us!</h5>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-xs-12 text-right wow fadeInRight" data-wow-delay="0.3s">
                     <a href="/merchant/register" class="btn btn-common">Register Now</a>
                 </div>
             </div>
         </div>
     </section>
     <!-- Call To Action Section Start -->
@endsection