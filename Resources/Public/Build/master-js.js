(self.webpackChunk=self.webpackChunk||[]).push([[632],{766:()=>{"use strict";var e,t,n,i,a=function(e,t){return{name:e,value:void 0===t?-1:t,delta:0,entries:[],id:"v1-".concat(Date.now(),"-").concat(Math.floor(8999999999999*Math.random())+1e12)}},r=function(e,t){try{if(PerformanceObserver.supportedEntryTypes.includes(e)){var n=new PerformanceObserver((function(e){return e.getEntries().map(t)}));return n.observe({type:e,buffered:!0}),n}}catch(e){}},o=function(e,t){var n=function n(i){"pagehide"!==i.type&&"hidden"!==document.visibilityState||(e(i),t&&(removeEventListener("visibilitychange",n,!0),removeEventListener("pagehide",n,!0)))};addEventListener("visibilitychange",n,!0),addEventListener("pagehide",n,!0)},c=function(e){addEventListener("pageshow",(function(t){t.persisted&&e(t)}),!0)},u="function"==typeof WeakSet?new WeakSet:new Set,s=function(e,t,n){var i;return function(){t.value>=0&&(n||u.has(t)||"hidden"===document.visibilityState)&&(t.delta=t.value-(i||0),(t.delta||void 0===i)&&(i=t.value,e(t)))}},f=-1,d=function(){return"hidden"===document.visibilityState?0:1/0},p=function(){o((function(e){var t=e.timeStamp;f=t}),!0)},v=function(){return f<0&&(f=d(),p(),c((function(){setTimeout((function(){f=d(),p()}),0)}))),{get timeStamp(){return f}}},m={passive:!0,capture:!0},l=new Date,h=function(i,a){e||(e=a,t=i,n=new Date,w(removeEventListener),S())},S=function(){if(t>=0&&t<n-l){var a={entryType:"first-input",name:e.type,target:e.target,cancelable:e.cancelable,startTime:e.timeStamp,processingStart:e.timeStamp+t};i.forEach((function(e){e(a)})),i=[]}},y=function(e){if(e.cancelable){var t=(e.timeStamp>1e12?new Date:performance.now())-e.timeStamp;"pointerdown"==e.type?function(e,t){var n=function(){h(e,t),a()},i=function(){a()},a=function(){removeEventListener("pointerup",n,m),removeEventListener("pointercancel",i,m)};addEventListener("pointerup",n,m),addEventListener("pointercancel",i,m)}(t,e):h(t,e)}},w=function(e){["mousedown","keydown","touchstart","pointerdown"].forEach((function(t){return e(t,y,m)}))};!function(e,t){var n,i=a("CLS",0),u=function(e){e.hadRecentInput||(i.value+=e.value,i.entries.push(e),n())},f=r("layout-shift",u);f&&(n=s(e,i,t),o((function(){f.takeRecords().map(u),n()})),c((function(){i=a("CLS",0),n=s(e,i,t)})))}(console.log),function(n,f){var d,p=v(),m=a("FID"),l=function(e){e.startTime<p.timeStamp&&(m.value=e.processingStart-e.startTime,m.entries.push(e),u.add(m),d())},h=r("first-input",l);d=s(n,m,f),h&&o((function(){h.takeRecords().map(l),h.disconnect()}),!0),h&&c((function(){var r;m=a("FID"),d=s(n,m,f),i=[],t=-1,e=null,w(addEventListener),r=l,i.push(r),S()}))}(console.log),function(e,t){var n,i=v(),f=a("LCP"),d=function(e){var t=e.startTime;t<i.timeStamp&&(f.value=t,f.entries.push(e)),n()},p=r("largest-contentful-paint",d);if(p){n=s(e,f,t);var m=function(){u.has(f)||(p.takeRecords().map(d),p.disconnect(),u.add(f),n())};["keydown","click"].forEach((function(e){addEventListener(e,m,{once:!0,capture:!0})})),o(m,!0),c((function(i){f=a("LCP"),n=s(e,f,t),requestAnimationFrame((function(){requestAnimationFrame((function(){f.value=performance.now()-i.timeStamp,u.add(f),n()}))}))}))}}(console.log)}},e=>{"use strict";var t;t=766,e(e.s=t)}]);