/**
 * StercSEO
 *
 * Copyright 2013 by Sterc <modx@sterc.nl>
 *
 * This file is part of StercSEO.
 *
 * StercSEO is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * StercSEO is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * StercSEO; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package stercseo
 */
/**
 * StercSEO JavaScript file for the stercseo-box in the manager.
 *
 * @author Sterc <modx@sterc.nl>
 *
 * @package stercseo
 */
var StercSEO = function(config) {
    config = config || {};
    config.record = {};
    StercSEO.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}

    ,isHidden: function(field){
    	if(Ext.getCmp(field).isVisible()){
    		return false;
    	}else{
    		return true;
    	}
    }

    ,highlightWords : function(input, words, className, tag){
        className = typeof className !== 'undefined' ? className : 'highlight';
        tag = typeof tag !== 'undefined' ? tag : 'span';

        for (key in words) {
            // /(Lorem)/g
            var reg = new RegExp(words[key],"g");

            input = input.replace(reg, '<'+tag+' class="'+className+'">'+words[key]+'</'+tag+'>');
        }
        return input;
    }
});
Ext.reg('stercseo',StercSEO);

StercSEO = new StercSEO();