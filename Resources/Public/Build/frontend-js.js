(self.webpackChunk=self.webpackChunk||[]).push([[476],{391:()=>{"use strict";var e=function(e,t){return{name:e,value:void 0===t?-1:t,delta:0,entries:[],id:"v1-".concat(Date.now(),"-").concat(Math.floor(8999999999999*Math.random())+1e12)}},t=function(e,t){try{if(PerformanceObserver.supportedEntryTypes.includes(e)){var n=new PerformanceObserver((function(e){return e.getEntries().map(t)}));return n.observe({type:e,buffered:!0}),n}}catch(e){}},n=function(e,t){var n=function n(i){"pagehide"!==i.type&&"hidden"!==document.visibilityState||(e(i),t&&(removeEventListener("visibilitychange",n,!0),removeEventListener("pagehide",n,!0)))};addEventListener("visibilitychange",n,!0),addEventListener("pagehide",n,!0)},i=function(e){addEventListener("pageshow",(function(t){t.persisted&&e(t)}),!0)},a="function"==typeof WeakSet?new WeakSet:new Set,r=function(e,t,n){var i;return function(){t.value>=0&&(n||a.has(t)||"hidden"===document.visibilityState)&&(t.delta=t.value-(i||0),(t.delta||void 0===i)&&(i=t.value,e(t)))}},o=-1,u=function(){n((function(e){var t=e.timeStamp;o=t}),!0)},s=function(){return o<0&&((o=self.webVitals.firstHiddenTime)===1/0&&u(),i((function(){setTimeout((function(){o="hidden"===document.visibilityState?0:1/0,u()}),0)}))),{get timeStamp(){return o}}};function c(e){if("undefined"!=typeof webvitalsAnalyticsUrl){var t=JSON.stringify({result:{id:e.id,value:e.value,name:e.name,hash:webvitalsHash}});navigator.sendBeacon&&navigator.sendBeacon(webvitalsAnalyticsUrl,t)||fetch(webvitalsAnalyticsUrl,{body:t,method:"POST",keepalive:!0})}}!function(a,o){var u,s=e("CLS",0),c=function(e){e.hadRecentInput||(s.value+=e.value,s.entries.push(e),u())},f=t("layout-shift",c);f&&(u=r(a,s,o),n((function(){f.takeRecords().map(c),u()})),i((function(){s=e("CLS",0),u=r(a,s,o)})))}(c),function(o,u){var c,f=s(),d=e("FID"),l=function(e){e.startTime<f.timeStamp&&(d.value=e.processingStart-e.startTime,d.entries.push(e),a.add(d),c())},v=t("first-input",l);c=r(o,d,u),v&&n((function(){v.takeRecords().map(l),v.disconnect()}),!0),v||window.webVitals.firstInputPolyfill(l),i((function(){d=e("FID"),c=r(o,d,u),window.webVitals.resetFirstInputPolyfill(),window.webVitals.firstInputPolyfill(l)}))}(c),function(o,u){var c,f=s(),d=e("LCP"),l=function(e){var t=e.startTime;t<f.timeStamp&&(d.value=t,d.entries.push(e)),c()},v=t("largest-contentful-paint",l);if(v){c=r(o,d,u);var m=function(){a.has(d)||(v.takeRecords().map(l),v.disconnect(),a.add(d),c())};["keydown","click"].forEach((function(e){addEventListener(e,m,{once:!0,capture:!0})})),n(m,!0),i((function(t){d=e("LCP"),c=r(o,d,u),requestAnimationFrame((function(){requestAnimationFrame((function(){d.value=performance.now()-t.timeStamp,a.add(d),c()}))}))}))}}(c),function(n,o){var u,c=s(),f=e("FCP"),d=t("paint",(function(e){"first-contentful-paint"===e.name&&(d&&d.disconnect(),e.startTime<c.timeStamp&&(f.value=e.startTime,f.entries.push(e),a.add(f),u()))}));d&&(u=r(n,f,o),i((function(t){f=e("FCP"),u=r(n,f,o),requestAnimationFrame((function(){requestAnimationFrame((function(){f.value=performance.now()-t.timeStamp,a.add(f),u()}))}))})))}(c)}},e=>{"use strict";var t;t=391,e(e.s=t)}]);