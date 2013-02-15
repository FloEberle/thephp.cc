brack.topNavi = function(list)
{
    list.children('.mainNavigation > li').mouseenter({parentThis: this}, function(e) {
        e.data.parentThis.delayEffect($(this));
    });

    list.mouseleave({parentThis: this}, function(e) {
        e.data.parentThis.delayEffect(null);
    });


    list.children('li').children('a').click({parentThis: this}, function(e) {
        e.data.parentThis.changeCurrent($(this).parent());
        e.preventDefault();
    });

}

brack.topNavi.prototype = 
{
    timeout: null,
    curObject: null,
    
    delayEffect: function(newObject) {
        //Eventuell laufende Verzögerung beenden
        window.clearTimeout(this.timeout);
        
        var _this = this;
        //Timeout starten
        this.timeout = window.setTimeout(
            function() { _this.changeCurrent(newObject); },
            this._getDelay(newObject)
        );
    },
    
    appear: function(object) {
        object.children('ul').show();
        object.addClass('active');
    },
    
    disappear: function(object) {
        object.children('ul').hide();
        object.parent().children('li').removeClass('active');
    },
    
    changeCurrent: function(newObject) {
        //Wenn es nicht die gleichen Objekte sind
        if(!this._areJQueryAndEqual(this.curObject, newObject)) {
                    
            if(this.curObject !== null)
            this.disappear(this.curObject);
            
            if(newObject !== null)
            this.appear(newObject);
                 
            this.curObject = newObject;
        }
    },
    
    _getDelay: function(newObject) {
        if (this.curObject == null) {
            // Wenn Navi noch geschlossen war
            return 500;
        } else if (newObject == null) {
            // Wenn Navi geschlossen werden soll
            return 250;
        } else {
            // Interne Änderungen
            return 250;
        }
    },
    
    _areJQueryAndEqual: function(object1, object2) {
        if (object1 instanceof jQuery && object2 instanceof jQuery) {
            return (object1.get(0) == object2.get(0));
        } else {
            return false;
        }
    }
}
