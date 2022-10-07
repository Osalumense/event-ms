@extends('admin.layouts.app')
@section('content')
    <div class="p-3 md:p-16 m-3">
        <div class="shadow-lg flex flex-row justify-start items-center rounded-md p-5 bg-white mb-4">
            <h1 class="text-3xl text-indigo-600 font-black">{{$event['title']}}</h1>
            @if($event['is_active'] == 1)
                <span class="flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                </span>
                <a target="_blank" {{url('/e/').'/'.$event['slug']}} href=""><i class='bx bx-link-external'></i></a>
            @else
                <i class='bx bxs-circle bx-md text-red-600 mr-3'></i>
            @endif  
        </div>
        <div class="flex flex-wrap" id="tabs-id">
            <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-indigo-600" onclick="changeAtiveTab(event,'tab-profile')">
                        Profile
                    </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-settings')">
                        Settings
                    </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-options')">
                        Options
                    </a>
                    </li>
                </ul>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="px-4 py-5 flex-auto">
                    <div class="tab-content tab-space">
                        <div class="block" id="tab-profile">
                        <p>
                            Collaboratively administrate empowered markets via
                            plug-and-play networks. Dynamically procrastinate B2C users
                            after installed base benefits.
                            <br />
                            <br />
                            Dramatically visualize customer directed convergence
                            without revolutionary ROI.
                        </p>
                        </div>
                        <div class="hidden" id="tab-settings">
                        <p>
                            Completely synergize resource taxing relationships via
                            premier niche markets. Professionally cultivate one-to-one
                            customer service with robust ideas.
                            <br />
                            <br />
                            Dynamically innovate resource-leveling customer service for
                            state of the art customer service.
                        </p>
                        </div>
                        <div class="hidden" id="tab-options">
                        <p>
                            Efficiently unleash cross-media information without
                            cross-media value. Quickly maximize timely deliverables for
                            real-time schemas.
                            <br />
                            <br />
                            Dramatically maintain clicks-and-mortar solutions
                            without functional solutions.
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    function changeAtiveTab(event,tabID){
      let element = event.target;
      while(element.nodeName !== "A"){
        element = element.parentNode;
      }
      ulElement = element.parentNode.parentNode;
      aElements = ulElement.querySelectorAll("li > a");
      tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
      for(let i = 0 ; i < aElements.length; i++){
        aElements[i].classList.remove("text-white");
        aElements[i].classList.remove("bg-indigo-600");
        aElements[i].classList.add("text-indigo-600");
        aElements[i].classList.add("bg-white");
        tabContents[i].classList.add("hidden");
        tabContents[i].classList.remove("block");
      }
      element.classList.remove("text-indigo-600");
      element.classList.remove("bg-white");
      element.classList.add("text-white");
      element.classList.add("bg-indigo-600");
      document.getElementById(tabID).classList.remove("hidden");
      document.getElementById(tabID).classList.add("block");
    }
  </script>
@endsection