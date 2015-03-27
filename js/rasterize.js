var page = new WebPage(),
    address, output, size,post;
page.settings.resourceTimeout = 10000; // 10 seconds
page.onResourceTimeout = function(e) {
    console.log(e.errorCode);   // it'll probably be 408
    console.log(e.errorString); // it'll probably be 'Network timeout on resource'
    console.log(e.url);         // the url whose request timed out
    phantom.exit();
};
if (phantom.args.length < 2 || phantom.args.length > 3) {
    console.log('Usage: rasterize.js URL filename');
    phantom.exit();
} else {
    address = phantom.args[0];
    post = phantom.args[1];
    output = phantom.args[2];
    //page.viewportSize = { width: 600, height: 600 };
    page.open(address,'POST', post,  function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            phantom.exit();
        } else {
            page.evaluate(function () {
                if(!document.body.style.backgroundColor){
                    document.body.style.backgroundColor = 'white';
                }
            });
            window.setTimeout(function () {
                page.render(output);
                phantom.exit();
            }, 200);
        }
    });

}