@php
  $t = now('Europe/Brussels')->diffInSeconds(now('Europe/Brussels')->startOfDay());
@endphp
<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" style="--offset: {{ $t }}s">
  <style>
    @keyframes bg { 0%{fill:#1d2030} 12%{fill:#434a70} 25%{fill:#ece4df} 50%{fill:#f3f1ec} 75%{fill:#cfbcb0} 100%{fill:#1d2030} }
    @keyframes win { 0%{fill:#2e3247} 12%{fill:#575e85} 25%{fill:#fbf1ea} 50%{fill:#fdfbf7} 75%{fill:#f6e2d5} 100%{fill:#2e3247} }
    @keyframes sh { 0%{flood-color:#1d2030} 12%{flood-color:#434a70} 25%{flood-color:#ece4df} 50%{flood-color:#f3f1ec} 75%{flood-color:#cfbcb0} 100%{flood-color:#1d2030} }
    .bg,.leaf { animation: bg 86400s linear infinite; animation-delay: var(--offset); }
    .window { animation: win 86400s linear infinite; animation-delay: var(--offset); }
    .sh { animation: sh 86400s linear infinite; animation-delay: var(--offset); }
  </style>
  <g clip-path="url(#a)">
    <rect class="bg" width="48" height="48" fill="#cfbcb0" rx="12"/>
    <g filter="url(#b)"><path class="window" fill="#f6e2d5" d="M-34 0h48v48h-48z"/></g>
    <g filter="url(#c)"><path class="window" fill="#f6e2d5" d="M14 0h48v48H14z"/></g>
    <g filter="url(#d)"><path class="leaf" fill="#cfbcb0" d="M43.453.64c-3.924-6.348-12.251-8.313-18.6-4.39 3.924 6.35 12.252 8.315 18.6 4.39"/></g>
    <g filter="url(#e)"><path class="leaf" fill="#cfbcb0" d="M45.611 4.896C40.442-.487 31.888-.66 26.504 4.508c5.17 5.384 13.724 5.558 19.107.388"/></g>
    <g filter="url(#f)"><path class="leaf" fill="#cfbcb0" d="M32.408 8.714c3.327 5.255 10.284 6.818 15.54 3.491-3.328-5.255-10.285-6.818-15.54-3.49"/></g>
    <g filter="url(#g)"><path class="leaf" fill="#cfbcb0" d="M27.329-.346a9.01 9.01 0 0 0-4.435 11.944A9.01 9.01 0 0 0 27.329-.346"/></g>
    <g filter="url(#h)"><path class="leaf" fill="#cfbcb0" d="M33.779 1.92c-5.757 2.356-8.513 8.931-6.158 14.688 5.756-2.356 8.513-8.932 6.158-14.688"/></g>
    <g filter="url(#i)"><path class="leaf" fill="#cfbcb0" d="M48.096 22.77a9.01 9.01 0 0 0-9.005-9.013 9.01 9.01 0 0 0 9.005 9.013"/></g>
    <g filter="url(#j)"><path class="leaf" fill="#cfbcb0" d="M37.187 7.455a9.01 9.01 0 0 0-2.801 12.429 9.01 9.01 0 0 0 2.8-12.43"/></g>
    <g filter="url(#k)"><path class="leaf" fill="#cfbcb0" d="M23.269-2.583a9.01 9.01 0 0 0-1.837 12.608 9.01 9.01 0 0 0 1.837-12.608"/></g>
  </g>
  <defs>
    <filter id="b" width="63" height="63" x="-41.5" y="-7.5" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
      <feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
      <feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
      <feMorphology in="SourceAlpha" radius="3" result="e1"/><feOffset/><feGaussianBlur stdDeviation="1.5"/>
      <feComposite in2="hardAlpha" k2="-1" k3="1" operator="arithmetic" result="sa"/>
      <feFlood class="sh" flood-color="#cfbcb0" flood-opacity="1" result="sc"/><feComposite in="sc" in2="sa" operator="in"/>
      <feBlend in2="shape" result="e1is"/><feGaussianBlur result="e2fb" stdDeviation="3.75"/>
    </filter>
    <filter id="c" width="63" height="63" x="6.5" y="-7.5" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
      <feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
      <feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
      <feMorphology in="SourceAlpha" radius="3" result="e1"/><feOffset/><feGaussianBlur stdDeviation="1.5"/>
      <feComposite in2="hardAlpha" k2="-1" k3="1" operator="arithmetic" result="sa"/>
      <feFlood class="sh" flood-color="#cfbcb0" flood-opacity="1" result="sc"/><feComposite in="sc" in2="sa" operator="in"/>
      <feBlend in2="shape" result="e1is"/><feGaussianBlur result="e2fb" stdDeviation="3.75"/>
    </filter>
    <filter id="d" width="28.6" height="18.431" x="19.853" y="-10.77" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="e" width="29.107" height="17.92" x="21.504" y="-4.258" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="f" width="25.539" height="16.987" x="27.408" y="1.966" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="g" width="16.079" height="21.944" x="17.072" y="-5.346" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="h" width="17.841" height="24.688" x="21.779" y="-3.08" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="i" width="19.005" height="19.014" x="34.091" y="8.757" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="j" width="15.592" height="22.429" x="27.991" y="2.455" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <filter id="k" width="15.412" height="22.608" x="14.645" y="-7.583" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur result="e1fb" stdDeviation="2.5"/></filter>
    <clipPath id="a"><rect width="48" height="48" fill="#fff" rx="12"/></clipPath>
  </defs>
</svg>
