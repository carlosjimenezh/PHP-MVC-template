// funciones que retornan el svg de los iconos

export function instagram(color = "black") {
  return `
    <svg 
        viewBox="0 0 420 419.997" 
        height="25"
        width="25"
        xmlns="http://www.w3.org/2000/svg"
    >
    <title/>
    <path 
        d="M388.818,146.28a24.3,24.3,0,1,1-24.295-24.295A24.3,24.3,0,0,1,388.818,146.28ZM466,256l-0.005.306-1.38,88.105a121.58,121.58,0,0,1-120.2,120.2L256,466l-0.306-.006-88.105-1.376a121.586,121.586,0,0,1-120.206-120.2L46,256l0.006-.306,1.376-88.108a121.59,121.59,0,0,1,120.206-120.2L256,46l0.306,0.006,88.105,1.376a121.584,121.584,0,0,1,120.2,120.2Zm-39.112,0-1.374-87.8A82.654,82.654,0,0,0,343.8,86.485L256,85.114l-87.8,1.371A82.658,82.658,0,0,0,86.484,168.2L85.113,256l1.371,87.8A82.655,82.655,0,0,0,168.2,425.515l87.8,1.371,87.8-1.371A82.651,82.651,0,0,0,425.514,343.8Zm-63.048,0A107.841,107.841,0,1,1,256,148.159,107.962,107.962,0,0,1,363.84,256Zm-39.107,0A68.734,68.734,0,1,0,256,324.734,68.812,68.812,0,0,0,324.732,256Z" 
        transform="translate(-46 -46.001)"
        fill="${color}"
    />
    </svg>
    `;
}

export function hamburger(color = "black") {
  return `
    <svg 
        height="512" 
        viewBox="0 0 512 512" 
        width="512" 
        xmlns="http://www.w3.org/2000/svg">
        <title/>
        <line style="fill:${color};stroke:${color};stroke-linecap:round;stroke-miterlimit:10;stroke-width:48px" x1="88" x2="424" y1="152" y2="152"/>
        <line style="fill:${color};stroke:${color};stroke-linecap:round;stroke-miterlimit:10;stroke-width:48px" x1="88" x2="424" y1="256" y2="256"/>
        <line style="fill:${color};stroke:${color};stroke-linecap:round;stroke-miterlimit:10;stroke-width:48px" x1="88" x2="424" y1="360" y2="360"/>
    </svg>
    `;
}

export function arrow(color = "black") {
  return `
    <svg 
      fill="none" 
      height="24" 
      stroke-width="1.5" 
      viewBox="0 0 24 24" 
      width="24" 
      xmlns="http://www.w3.org/2000/svg">
      <path 
        d="M15 6L9 12L15 18" 
        stroke="${color}" 
        stroke-linecap="round" 
        stroke-linejoin="round"
      />
    </svg>
    `;
}

export function close(color = "black") {
  return `
    <svg 
      fill="${color}"
      height="512px" 
      id="Layer_1" 
      style="enable-background:new 0 0 512 512;" 
      version="1.1" 
      viewBox="0 0 512 512" 
      width="512px" 
      xml:space="preserve" 
      xmlns="http://www.w3.org/2000/svg" 
      xmlns:xlink="http://www.w3.org/1999/xlink"
    >
    <path 
    d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/>
    </svg>
    `;
}

export function logout(color = "black") {
  return `
    <svg 
      height="24" 
      viewBox="0 0 24 24" 
      width="24" 
      fill="${color}"
      xmlns="http://www.w3.org/2000/svg"
      >
        <path 
        d="M16 13v-2H7V8l-5 4 5 4v-3z"
        />
        <path 
        d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"
        />
    </svg>
    `;
}

export function show(color = "black") {
  return `
 <svg 
 id="Outlined" 
 viewBox="0 0 32 32" 
 xmlns="http://www.w3.org/2000/svg"
 fill="${color}"
 >
 <g 
 id="Fill"
 >
 <path 
 d="M30.89,15.54A17,17,0,0,0,16,6,17,17,0,0,0,1.11,15.54L.87,16l.24.46A17,17,0,0,0,16,26a17,17,0,0,0,14.89-9.54l.24-.46ZM24,16a8,8,0,1,1-8-8A8,8,0,0,1,24,16ZM3.14,16a16.47,16.47,0,0,1,4.14-4.89,10,10,0,0,0,0,9.78A16.47,16.47,0,0,1,3.14,16Zm21.58,4.89a10,10,0,0,0,0-9.78A16.47,16.47,0,0,1,28.86,16,16.47,16.47,0,0,1,24.72,20.89Z"
 />
 <path 
 d="M16,20a4,4,0,1,0-4-4A4,4,0,0,0,16,20Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,16,14Z"
 />
 </g>
 </svg>
  `;
}

export function iconDelete(color = "black") {
  return `
  <svg 
  id="Layer_1" 
  style="enable-background:new 0 0 64 64;" 
  version="1.1" 
  viewBox="0 0 64 64" 
  fill="${color}"
  xml:space="preserve" 
  xmlns="http://www.w3.org/2000/svg" 
  xmlns:xlink="http://www.w3.org/1999/xlink"
  >
  <g>
  <g 
  id="Icon-Trash" 
  transform="translate(232.000000, 228.000000)"
  >
  <polygon 
  class="st0" 
  id="Fill-6" 
  points="-207.5,-205.1 -204.5,-205.1 -204.5,-181.1 -207.5,-181.1    "
  />
  <polygon 
  class="st0" 
  id="Fill-7" 
  points="-201.5,-205.1 -198.5,-205.1 -198.5,-181.1 -201.5,-181.1    "
  />
  <polygon 
  class="st0" 
  id="Fill-8" 
  points="-195.5,-205.1 -192.5,-205.1 -192.5,-181.1 -195.5,-181.1    "
  />
  <polygon 
  class="st0" 
  id="Fill-9" 
  points="-219.5,-214.1 -180.5,-214.1 -180.5,-211.1 -219.5,-211.1    "
  />
  <path 
  class="st0" d="M-192.6-212.6h-2.8v-3c0-0.9-0.7-1.6-1.6-1.6h-6c-0.9,0-1.6,0.7-1.6,1.6v3h-2.8v-3     c0-2.4,2-4.4,4.4-4.4h6c2.4,0,4.4,2,4.4,4.4V-212.6" 
  id="Fill-10"/><path class="st0" d="M-191-172.1h-18c-2.4,0-4.5-2-4.7-4.4l-2.8-36l3-0.2l2.8,36c0.1,0.9,0.9,1.6,1.7,1.6h18     c0.9,0,1.7-0.8,1.7-1.6l2.8-36l3,0.2l-2.8,36C-186.5-174-188.6-172.1-191-172.1" 
  id="Fill-11"/>
  </g>
  </g>
  </svg>
  `;
}

export function edit(color = "black") {
  return `
  <svg 
  viewBox="0 0 32 32" 
  xmlns="http://www.w3.org/2000/svg"
  fill="${color}"
  >
  <g 
  data-name="Layer 18" 
  id="Layer_18"
  >
  <path 
  class="cls-1" 
  d="M2,31a1,1,0,0,1-1-1.11l.9-8.17a1,1,0,0,1,.29-.6L21.27,2.05a3.56,3.56,0,0,1,5.05,0L30,5.68a3.56,3.56,0,0,1,0,5.05L10.88,29.8a1,1,0,0,1-.6.29L2.11,31Zm8.17-1.91h0ZM3.86,22.28l-.73,6.59,6.59-.73L28.54,9.31a1.58,1.58,0,0,0,0-2.22L24.91,3.46a1.58,1.58,0,0,0-2.22,0Z"
  />
  <path 
  class="cls-1" 
  d="M26.52,13.74a1,1,0,0,1-.7-.29L18.55,6.18A1,1,0,0,1,20,4.77L27.23,12a1,1,0,0,1,0,1.41A1,1,0,0,1,26.52,13.74Z"
  />
  <rect 
  class="cls-1" 
  height="2" 
  transform="translate(-7.91 15.47) 
  rotate(-45)" 
  width="12.84" 
  x="8.29" 
  y="16.28"/>
  </g>
  </svg>
  `;
}
