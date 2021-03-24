import {getLCP, getFID, getCLS, getFCP} from 'web-vitals/base';

function sendToAnalytics(metric) {
    if (typeof webvitalsAnalyticsUrl !== "undefined") {
        const body = JSON.stringify({'result': {id: metric.id, value: metric.value, name: metric.name, hash: webvitalsHash}});
        (navigator.sendBeacon && navigator.sendBeacon(webvitalsAnalyticsUrl, body)) ||
        fetch(webvitalsAnalyticsUrl, {body, method: 'POST', keepalive: true});
    }
}

getCLS(sendToAnalytics);
getFID(sendToAnalytics);
getLCP(sendToAnalytics);
getFCP(sendToAnalytics);