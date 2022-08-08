@extends('client.layout.index')
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Contact Us</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li class="active" aria-current="page">Contact Us</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...::::Start Map Section:::... -->
    <div class="map-section" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558814064!2d105.74459841443594!3d21.038132792835242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sen!2s!4v1659938511765!5m2!1sen!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...::::End  Map Section:::... -->

    <!-- ...::::Start Contact Section:::... -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Start Contact Details -->
                    <div class="contact-details-wrapper section-top-gap-100" data-aos="fade-up" data-aos-delay="0">
                        <div class="contact-details">
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <a href="tel:+012345678102">+012 345 678 102</a>
                                    <a href="tel:+012345678102">+012 345 678 102</a>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <a href="mailto:urname@email.com">nguyenvanloi0105202@gmail.com</a>
                                    <a href="http://www.yourwebsite.com/">Hono.yourwebsite.com</a>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <span>Address goes here,</span>
                                    <span>Minh Khai - Bắc Từ Liêm - HN</span>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                        </div>
                        <!-- Start Contact Social Link -->
                        <div class="contact-social">
                            <h4>Follow Us</h4>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> <!-- End Contact Social Link -->
                    </div> <!-- End Contact Details -->
                </div>
                <div class="col-lg-8">
                    <div class="contact-form section-top-gap-100" data-aos="fade-up" data-aos-delay="200">
                        <h3>Get In Touch</h3>
                        <div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('contactStore') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-name">Name</label>
                                        <input name="name" type="text" id="contact-name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-email">Email</label>
                                        <input name="email" type="email" id="contact-email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-subject">Title</label>
                                        <input name="subject" type="text" id="contact-subject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-message">Your Message</label>
                                        <textarea name="message" id="contact-message" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary ">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...::::ENd Contact Section:::... -->
@endsection
