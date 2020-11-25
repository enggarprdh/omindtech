
        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            @if(Count($dataPlugins) > 0)
                              
                                @foreach ($dataPlugins as $item)
                                        
                                        @if(Count($item) > 1)
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="{{$item[0]->plugin_icon}} mr-2"></i>
                                                        @lang($item[0]->pluginName)
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                                @foreach ($item as $data)
                                                
                                                    <a href="{{url($data->urlPath)}}" class="dropdown-item">
                                                        @lang($data->featureName)
                                                    </a>                                                
                                                @endforeach
                                                </div>
                                            </li>
                                        @else 
                                            <li class="nav-item">
                                                <a href="{{url($item[0]->urlPath)}}" class="nav-link">
                                                    <i class="{{$item[0]->feature_icon}} mr-2"></i>
                                                    @lang($item[0]->featureName)
                                                </a>
                                            </li>
                                        @endif
                                        <br/>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </nav>
            </div>
        </div>