@extends('layouts.dashboard')
@section('content') 

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Application Development</h2>
                <p class="lead">This Aplication is built for use sample Laravel Online Blog Operation. For this application laravel 5.3 is used<br> More services will be added periodically </p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
							<center>
								<i class="fa fa-user"></i>
								<h2>About Application</h2>
							</center>
                            <h3>User can see the topic , post and comment of blog. User will be able to write a post after complete registering and login  to the panel. An user can edit his or her  own comment and post.</h3>              
                        </div>
                    </div><!--/.col-md-6-->

                    <div class="col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <center>    
                                <i class="fa fa-user-md (doctor)"></i>
                                <h2>Instructions</h2>
                            </center>   
                            <h3>First unzip the project. Then rum composer update command.</h3>
                            <h3>Then create a database and then add it in the .env file. Also change the Username & Password Field.</h3>
                            <h3>Then run command php artisan migrate.</h3>
                            <h3>You are now set to use this Application</h3>
                        </div>
                    </div><!--/.col-md-6-->
                </div><!--/.services-->
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#feature-->
@stop