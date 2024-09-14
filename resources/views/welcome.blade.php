<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Sistem Informasi Tefa</title>
        <meta name="description" content="Simple landind page" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="images/icon.png" type="image/png">
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
        <style>
          .gradient {
            background: linear-gradient(90deg, #D7C3F1 0%, #a743dd 100%);
          }
          .static-text {
            display: inline;
            font-weight: bold;
          }
          #dynamic-text {
            display: inline;
            white-space: nowrap;
            border-right: 2px solid white;
            animation: blink 0.7s infinite;
          }
          @keyframes blink {
            0% {
              border-color: white;
            }
            50% {
              border-color: transparent;
            }
            100% {
              border-color: white;
            }
          }
          .text-white-scroll {
            color: white;
          }
          .text-purple-900-scroll {
            color: #4A154B;
          }
        </style>
      </head>
    <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
        <nav id="header" class="fixed w-full z-30 top-0 text-white">
          <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
              <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                <img src="./images/chlorine.png" alt="logo" class="h-10 w-full" />
              </a>
            </div>
            <div class="block lg:hidden pr-4">
              <button id="nav-toggle" class="flex items-center p-1 text-purple-900 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <title>Menu</title>
                  <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
              </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
              <ul class="list-reset lg:flex justify-end flex-1 items-center text-white-scroll">
                <li class="mr-3">
                  <a class="inline-block py-2 px-4 text-black text-white-scroll font-bold no-underline" href="#">Action</a>
                </li>
                <li class="mr-3">
                  <a class="inline-block text-white-scroll text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">Action</a>
                </li>
                <li class="mr-3">
                  <a class="inline-block text-white-scroll text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">Action</a>
                </li>
                <li class="mr-3">
                  <a class="inline-block text-white-scroll text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">Action</a>
                </li>
                <li class="mr-3">
                  <a class="inline-block text-white-scroll text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">Action</a>
                </li>
              </ul>
              <a
                href="/tefa"
                class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
              >
                Login
            </a>
            </div>
          </div>
          <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
        </nav>
    
        <div class="pt-24">
          <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
              <p class="uppercase tracking-loose w-full text-purple-800">What business are you?</p>
              <h1 class="my-4 text-5xl font-bold leading-tight text-purple-800">
                <span class="static-text">Sistem </span><span id="dynamic-text"></span>
              </h1>
              <p class="leading-normal text-2xl mb-8">
                Sistem informasi mengenai TeFa yang di dampingi oleh Industry meliputi hasil riset, produk, omzet dst. Terdapat informasi TeFa mana yang sudah mencapai kelayakan bisnis ke masyarakat, dukungan permodalan, marketing dan perluasan pasar melalui relasi industri.
            </p>
              <div class="flex space-x-4">
                <a href="/tefa" class="mx-auto lg:mx-0 bg-purple-900 text-white hover:bg-white hover:text-purple-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition-all hover:scale-105 duration-300 ease-in-out">
                  Login
                </a>
                <a href="/tefa/register" class="mx-auto lg:mx-0 hover:bg-purple-900 hover:text-white bg-white text-purple-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition-all hover:scale-105 duration-300 ease-in-out">
                  Register
                </a>
              </div>
            </div>
            <div class="w-full md:w-3/5 py-6 text-center flex justify-end">
              <img class="w-full md:w-4/5 z-50" src="images/hero.png" />
            </div>
          </div>
        </div>
    
        <div class="relative -mt-12 lg:-mt-24">
          <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
              </g>
              <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
              </g>
            </g>
          </svg>
        </div>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
          var scrollpos = window.scrollY;
          var header = document.getElementById("header");
          var navcontent = document.getElementById("nav-content");
          var navaction = document.getElementById("navAction");
          var toToggle = document.querySelectorAll(".toggleColour");
          var navLinks = document.querySelectorAll("#nav-content a");
        
          document.addEventListener("scroll", function () {
            scrollpos = window.scrollY;
        
            if (scrollpos > 10) {
              header.classList.add("bg-white");
              navaction.classList.remove("bg-white");
              navaction.classList.add("bg-purple-900");
              navaction.classList.remove("text-gray-800");
              navaction.classList.add("text-white");
              
              toToggle.forEach(el => {
                el.classList.add("text-gray-800");
                el.classList.remove("text-white");
              });
        
              header.classList.add("shadow");
              navcontent.classList.remove("bg-gray-100");
              navcontent.classList.add("bg-white");
        
              navLinks.forEach(link => link.classList.remove("text-white-scroll"));
              navLinks.forEach(link => link.classList.add("text-purple-900-scroll"));
            } else {
              header.classList.remove("bg-white");
              navaction.classList.remove("bg-purple-900");
              navaction.classList.add("bg-white");
              navaction.classList.remove("text-white");
              navaction.classList.add("text-gray-800");
        
              toToggle.forEach(el => {
                el.classList.add("text-white");
                el.classList.remove("text-gray-800");
              });
        
              header.classList.remove("shadow");
              navcontent.classList.remove("bg-white");
              navcontent.classList.add("bg-gray-100");
        
              navLinks.forEach(link => link.classList.remove("text-purple-900-scroll"));
              navLinks.forEach(link => link.classList.add("text-white-scroll"));
            }
          });
    
          var navMenuDiv = document.getElementById("nav-content");
          var navMenu = document.getElementById("nav-toggle");
    
          document.onclick = check;
          function check(e) {
            var target = (e && e.target) || (event && event.srcElement);
    
            if (!checkParent(target, navMenuDiv)) {
              if (checkParent(target, navMenu)) {
                if (navMenuDiv.classList.contains("hidden")) {
                  navMenuDiv.classList.remove("hidden");
                } else {
                  navMenuDiv.classList.add("hidden");
                }
              } else {
                navMenuDiv.classList.add("hidden");
              }
            }
          }
    
          function checkParent(t, elm) {
            while (t.parentNode) {
              if (t == elm) {
                return true;
              }
              t = t.parentNode;
            }
            return false;
          }
    
          const textArray = ["Monitoring", "Manajemen"];
          let textIndex = 0;
          let charIndex = 0;
          let isDeleting = false;
          const speed = 100;
          const dynamicTextElement = document.getElementById("dynamic-text");
          const delayBetweenWords = 1000;
          const deleteSpeed = 50;
    
          function typeWriter() {
            const currentText = textArray[textIndex];
            
            if (isDeleting) {
              dynamicTextElement.innerHTML = currentText.substring(0, charIndex - 1);
              charIndex--;
              
              if (charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % textArray.length;
                setTimeout(typeWriter, 500);
              } else {
                setTimeout(typeWriter, deleteSpeed);
              }
            } else {
              dynamicTextElement.innerHTML = currentText.substring(0, charIndex + 1);
              charIndex++;
              
              if (charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(typeWriter, delayBetweenWords);
              } else {
                setTimeout(typeWriter, speed);
              }
            }
          }
    
          window.onload = typeWriter;
        </script>
      </body>
</html>
