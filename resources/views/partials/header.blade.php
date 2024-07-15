 <!-- Navbar -->

 <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

      </li>



    </ul>

    <div class="row  ml-auto mr-auto">
      
     <div class="col-12">
      @if(request()->get('track_number') )
      <h5 class="h5">Last Created File Track Number : <strong>{{ request()->get('track_number') ?? ''}}</strong></h5> 
      @endif
     </div>
    </div>

    <!-- Right navbar links -->

    <ul class="navbar-nav ">

      <!-- Navbar Search -->




      <!-- Messages Dropdown Menu -->

       <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          <i class="far fa-comments"></i>

          <span class="badge badge-danger navbar-badge">{{$notifications->count()}}</span>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          @foreach ($notifications as $item)

          <a href="{{route('track.show',$item->id)}}" class="dropdown-item">

            <!-- Message Start -->

            <div class="media">              

              <div class="media-body">

                <h3 class="dropdown-item-title">

                  {{$item->file_type}}

                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>

                </h3>

                <p class="text-sm">{{$item->name ?? $item->subject}}</p>

                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $item->updated_at->format('d F Y  |  h:i A') }}</p>

              </div>

            </div>

            <!-- Message End -->

          </a>

          <div class="dropdown-divider"></div>

          @endforeach

          

          

      

          <a href="{{route('myfile.intransit')}}" class="dropdown-item dropdown-footer">See All Messages</a>

        </div>

      </li> 



      <li class="nav-item">

        <a class="nav-link" data-widget="fullscreen" href="#" role="button">

          <i class="fas fa-expand-arrows-alt"></i>

        </a>

      </li>

      {{-- <li class="nav-item">

        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">

          <i class="fas fa-th-large"></i>

        </a>

      </li> --}}

    </ul>

  </nav>

  <!-- /.navbar -->

