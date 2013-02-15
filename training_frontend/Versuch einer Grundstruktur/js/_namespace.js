var brack = {};

/**
 * Ergänzt das brack-Objekt mit der Methode create. Mit dieser Methode können neue
 * Klassen erstellt werden. Die so erstellten Klassen haben einige Besonderheiten:
 * 
 * - Erstellte Klassen erhalten eine extend()-Methode, wodurch eine neue Klasse abgeleitet werden kann
 *   Beispiel: var bar = foo.extend({...definition...});
 * - Methoden von extendeten Klassen haben mit this.super() Zugriff auf ihre Parent-Methoden 
 *   Beispiel: var bar = foo.extend({execute: function() { this.super();}); 
 *             this.super() ruft nun bar.execute() im Kontext von foo auf
 *   
 * Die Methoden .create() bzw .extend() ...          
 * ... erhalten ein Objekt übergeben. Der Key "init" ist hierbei speziell.
 *     Wenn es eine Funktion ist, dient sie als Konstruktor der neuen Klasse
 *   
 * ... kümmern sich darum, dass der typeof-Operator von JS sowohl für die eigene Klasse,
 *     als auch für dessen Parents erfüllt ist
 */
(function(ns){
    var isFn = function(fn) { return typeof fn == "function"; };
    var PClass = function(){};
    PClass.create = function(proto) {
        var k = function(magic) { // call init only if there's no magic cookie
            if (magic != isFn && isFn(this.init)) this.init.apply(this, arguments);
        };
        k.prototype = new this(isFn); // use our private method as magic cookie
        for (key in proto) (function(fn, sfn) { // create a closure
            k.prototype[key] = !isFn(fn) || !isFn(sfn) ? fn : // add _super method
            function() { this._super = sfn; return fn.apply(this, arguments); };
        })(proto[key], k.prototype[key]);
        k.prototype.constructor = k;
        k.extend = this.extend || this.create;
        return k;
    };
    ns.create = function(proto) {
        return PClass.create(proto);
    }
})(brack);
