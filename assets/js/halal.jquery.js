/**
 * Archive of the original jQuery-dependent script, unpacked.
 */
(function($) {
    function getTransformProperty(a) {
        var b = ['transform', 'WebkitTransform', 'MozTransform'];
        var p;
        while (p = b.shift()) {
            if (typeof a.style[p] != 'undefined') {
                return p;
            }
        }
        return 'transform';
    }
    
    var c = $.fn.css;
    $.fn.css = function(a) {
        if (typeof $.props['transform'] == 'undefined' && (a == 'transform' || (typeof a == 'object' && typeof a['transform'] != 'undefined'))) {
            $.props['transform'] = getTransformProperty(this.get(0));
        }
        if (a == 'transform') {
            a = $.props['transform'];
        }
        return c.apply(this, arguments);
    };
})(jQuery);

(function($) {
    var e = 'deg';
    $.fn.rotate = function(a) {
        var b = $(this).css('transform') || 'none';
        if (typeof a == 'undefined') {
            if (b) {
                var m = b.match(/rotate\(([^)]+)\)/);
                if (m && m[1]) {
                    return m[1];
                }
            }
            return 0;
        }
        var m = a.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (m) {
            if (m[3]) {
                e = m[3];
            }
            $(this).css('transform', b.replace(/none|rotate\([^)]*\)/, '') + 'rotate(' + m[1] + e + ')');
        }
    };
    
    $.fn.scale = function(a, b, c) {
        var d = $(this).css('transform');
        if (typeof a == 'undefined') {
            if (d) {
                var m = d.match(/scale\(([^)]+)\)/);
                if (m && m[1]) {
                    return m[1];
                }
            }
            return 1;
        }
        $(this).css('transform', d.replace(/none|scale\([^)]*\)/, '') + 'scale(' + a + ')');
    };
    
    var f = $.fx.prototype.cur;
    $.fx.prototype.cur = function() {
        if (this.prop == 'rotate') {
            return parseFloat($(this.elem).rotate());
        } else if (this.prop == 'scale') {
            return parseFloat($(this.elem).scale());
        }
        return f.apply(this, arguments);
    };
    
    $.fx.step.rotate = function(a) {
        $(a.elem).rotate(a.now + e);
    };
    
    $.fx.step.scale = function(a) {
        $(a.elem).scale(a.now);
    };
    
    var g = $.fn.animate;
    $.fn.animate = function(a) {
        if (typeof a['rotate'] != 'undefined') {
            var m = a['rotate'].toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            if (m && m[5]) {
                e = m[5];
            }
            a['rotate'] = m[1];
        }
        return g.apply(this, arguments);
    };
})(jQuery);

$('.item').hover(function() {
    var a = $(this);
    expand(a);
}, function() {
    var a = $(this);
    collapse(a);
});

function expand(a) {
    var b = 0;
    var t = setInterval(function() {
        if (b == 1440) {
            clearInterval(t);
            return;
        }
        b += 40;
        $('.link', a).stop().animate({ rotate: '+=-40deg' }, 0);
    }, 10);
    
    a.stop().animate({ width: '300px' }, 1000).find('.item_content').fadeIn(400, function() {
        $(this).find('p').stop(true, true).fadeIn(600);
    });
}

function collapse(a) {
    var b = 1440;
    var t = setInterval(function() {
        if (b == 0) {
            clearInterval(t);
            return;
        }
        b -= 40;
        $('.link', a).stop().animate({ rotate: '+=40deg' }, 0);
    }, 10);
    
    a.stop().animate({ width: '52px' }, 1000).find('.item_content').stop(true, true).fadeOut().find('p').stop(true, true).fadeOut();
}

$('#go').click(function() {
    window.location = "halal.php?q=" + $('#stext').val() + "&s=" + $('#stype').val();
});

$('div.iname').cluetip({ local: true, cursor: 'pointer' });

$('div.stat[title="Haram"]').parents('.clear').css('color', 'red');
$('div.stat[title="Depends"]').parents('.clear').css('color', 'blue');
$('div.stat[title="Mushbooh"]').parents('.clear').css('color', 'orange');
$('div.clear .iname:even, div.clear .stat:even').css('background-color', '#dae6f4');
