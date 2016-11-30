var _vengage = _vengage || [];
(function(){
    var a, b, c;
    a = function (f) {
        return function () {
            _vengage.push([f].concat(Array.prototype.slice.call(arguments, 0)));
        };
    };
    b = ['load', 'addRule', 'addVariable', 'getURLParam', 'addRuleByParam', 'addVariableByParam', 'trackAction', 'submitFeedback', 'submitResponse', 'close', 'minimize', 'openModal', 'helpers'];
    for (c = 0; c < b.length; c++) {
        _vengage[b[c]] = a(b[c]);
    }
    var t = document.createElement('script'),
        s = document.getElementsByTagName('script')[0];
    t.async = true;
    t.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://s3.amazonaws.com/vetrack/init.min.js';
    s.parentNode.insertBefore(t, s);
    _vengage.push(['pubkey', 'd1b0e60e-aa3e-42f8-9e92-dc57f2ac5855']);
})();