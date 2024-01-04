<div class="relative hidden h-screen my-4 ml-4 shadow-lg lg:block w-80">
    <div class="h-full bg-white rounded-2xl">
        <div class="flex items-center justify-center pt-6">
            <svg width="35" height="30" viewBox="0 0 256 366" version="1.1" preserveAspectRatio="xMidYMid">
                <defs>
                    <linearGradient x1="12.5189534%" y1="85.2128611%" x2="88.2282959%" y2="10.0225497%"
                        id="linearGradient-1">
                        <stop stop-color="#FF0057" stop-opacity="0.16" offset="0%">
                        </stop>
                        <stop stop-color="#FF0057" offset="86.1354%">
                        </stop>
                    </linearGradient>
                </defs>
                <g>
                    <path
                        d="M0,60.8538006 C0,27.245261 27.245304,0 60.8542121,0 L117.027019,0 L255.996549,0 L255.996549,86.5999776 C255.996549,103.404155 242.374096,117.027222 225.569919,117.027222 L145.80812,117.027222 C130.003299,117.277829 117.242615,130.060011 117.027019,145.872817 L117.027019,335.28252 C117.027019,352.087312 103.404567,365.709764 86.5997749,365.709764 L0,365.709764 L0,117.027222 L0,60.8538006 Z"
                        fill="#001B38">
                    </path>
                    <circle fill="url(#linearGradient-1)"
                        transform="translate(147.013244, 147.014675) rotate(90.000000) translate(-147.013244, -147.014675) "
                        cx="147.013244" cy="147.014675" r="78.9933938">
                    </circle>
                    <circle fill="url(#linearGradient-1)" opacity="0.5"
                        transform="translate(147.013244, 147.014675) rotate(90.000000) translate(-147.013244, -147.014675) "
                        cx="147.013244" cy="147.014675" r="78.9933938">
                    </circle>
                </g>
            </svg>
        </div>
        <nav class="mt-6">
            <div>
                <a class="flex items-center justify-start w-full p-4 my-2 font-thin text-blue-500 uppercase transition-colors duration-200
                {{ !request()->routeIs('loan.index') ?: 'border-r-4 border-blue-500 bg-gradient-to-r from-white to-blue-100' }}"
                    href={{route('loan.index')}}>
                    <span class="text-left">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 2048 1792"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1070 1178l306-564h-654l-306 564h654zm722-282q0 182-71 348t-191 286-286 191-348 71-348-71-286-191-191-286-71-348 71-348 191-286 286-191 348-71 348 71 286 191 191 286 71 348z">
                            </path>
                        </svg>
                    </span>
                    <span class="mx-4 text-sm font-normal">
                        Loans
                    </span>
                </a>

            </div>
            <div>
                <a class="flex items-center justify-start w-full p-4 my-2 font-thin text-blue-500 uppercase transition-colors duration-200
                {{ !(request()->routeIs('loan.calculator')||request()->routeIs('loan.result')) ?: 'border-r-4 border-blue-500 bg-gradient-to-r from-white to-blue-100' }}"
                    href={{route('loan.calculator')}}>
                    <span class="text-left">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 2048 1792"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1070 1178l306-564h-654l-306 564h654zm722-282q0 182-71 348t-191 286-286 191-348 71-348-71-286-191-191-286-71-348 71-348 191-286 286-191 348-71 348 71 286 191 191 286 71 348z">
                            </path>
                        </svg>
                    </span>
                    <span class="mx-4 text-sm font-normal">
                        Calculator
                    </span>
                </a>

            </div>
        </nav>
    </div>
</div>
