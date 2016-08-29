/*global jQuery: true */

/*!
   --------------------------------
   Infinite Scroll
   --------------------------------
   + https://github.com/paulirish/infinite-scroll
   + version 2.1.0
   + Copyright 2011/12 Paul Irish & Luke Shumard
   + Licensed under the MIT license

   + Documentation: http://infinite-scroll.com/
*/

// Uses AMD or browser globals to create a jQuery plugin.
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($, undefined) {
    'use strict';

    $.infinitescroll = function infscr(options, callback, element) {
        this.element = $(element);

        // Flag the object in the event of a failed creation
        if (!this._create(options, callback)) {
            this.failed = true;
        }
    };

    $.infinitescroll.defaults = {
        loading: {
            finished: undefined,
            finishedMsg: "<em>Больше нечего загружать.</em>",
            img: 'data:image/gif;base64,R0lGODlhhACEAPcAAAAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj4yVl4qcnoeipYassX+8xHnI03PR3m3a6Gfg8GPk9V/n+V3o/Fvp/Vrq/lnq/lnq/lnq/lnq/lnq/lnr/lnr/lnr/lnr/lnr/lrr/lvr/lzr/l7r/mHr/mXs/mns/m/t/nTu/nju/nvu/n7v/oPv/onw/pHx/pny/qTz/q71/rn2/sf4/tD5/tX5/tn6/t/7/uH7/uT7/+b8/+j8/+r8/+z9/+/9//L9//b+//f+//n+//r+//r+//z+//7+//7+//7+//7+//7+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yH/C05FVFNDQVBFMi4wAwEAAAAh+QQJBADpACwAAAAAhACEAAAI/gDTCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzJs6fPn0CDCh1KtKjRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Ltyuyug174W24ay9DXX4VAusbGOEuvYUP5rqb2CCtxgdvQXY8mSCyx5UF9sKceXNmzZwre/48unOsz+l6nUKtmvUpxJWRneKF+lQu1Kwkf6Z1+vOtU4wr65pN+hSu2q9Q0zpF7HMu45+BnUr++dUpYGGDc8R1SvdX2h6J/p1i/pUY9o/Lb3tV/3HXqVbasyJj/9E6/ay4mod8Dn8rMe8gIcOKbVvdAtt+4+l3FTGhhYSMdQ1SRct5JLlHnFW6HHfScv1RRcwr8Y0k3im2VEULYCk9dwqKUeXSm0qxvEehU7uwMiNKxAwYS4hJAdMKiyvxMl6ESBHTSi0wcdcdU8jEAmJMtYwHoFFN2ihTk1IiVeWNL2G5ZFFYEkaTl7TwyBMw1olZk5excLkTL62coqZNXrYCXk8qzonTb+PddxODp1jpk4qn0KKgTbrE2WZQvQz4np8w9RKjcWbudNl4p8RyoEvI8MnKnUTxYt2Qm6Y0X5yn1FIpUMgoOSSojyYho8uor5R61GaYTrfLqhv9hyorkCr1X67d2ZoRMbpMGuhiHuLi6Hit2LLLoRUBk2yurzCL1S7LEfuKLbn0Qq1CxPSSiy2oYmqgV8TgoiyxmdJySy701osLLbzBG+gtvPCKFTK85ELLs/oWjCkt4bJVLr34jkosvrjkwoubqFVs8cUYZ6zxxhx37PHHBwUEACH5BAkEAO8ALAAAAACEAIQAhwAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjYqTlYianICpr3m2v3PBy2/M2GvU4mja6mTg8WDk913n+lzp/Frq/Vrq/lnq/lnq/lnq/lnq/lnq/lnq/lnq/lnr/lrr/lvr/l3r/mDr/mLs/mTs/mjs/m3t/nPt/nfu/nzv/oDv/oPw/ojw/ovx/o7x/pHx/pLx/pXy/pfy/pny/pzz/qDz/qb0/q/1/rf2/r73/sX4/s75/9P5/9f6/9r6/936/+D7/+L7/+P7/+T7/+b8/+j8/+r8/+v8/+/9//L9//T+//X+//b+//f+//j+//j+//n+//v+//z+//z+//3+//7+//7+//7+//7+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wj+AN8JHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOHPq3Mmzp8+fQIMKHUq0qNGjSJMqXcq0qdOnUKNKnUq1qtWrWLNq3cq1q9evYMOKtVls7MdiZc127KW2I69lbTcu0xV34y24dTEuu5U3492+F5fBAnyRly/CFlM9Q0zRF1/GE2Udhhzx2ajFlCH6apU5oiy6nR+OmhyaobBRaUsv5DVKdUNZg10vXPVYNkLLvGwnPA1MN8Jeo4T5Psha+PCCuoIfLwhL+fKBzY0/fxd9usDq1rFP1/68Oennskb+5bbOGvR01rGnAxu1yvq7062tW3Y+fZV49+FluQeeyn2xUai5h8p91oXHmXW+AIjXc/OxVeAoB06XIH3PDVjbc8mNsuByywB44XLhaWgdfB8edwuA0nEIYHvkATgegwOmktpy60GIn4vyDUjhcTWmsiFTKa4EHISYAVlkSycSyZQvM7rUCoARIuWLgzE9o2OJQzlW0zNPKlmUljZxCeWRQIF5k5ijyCiULljS9EyIqXy30zOwtGlThqOYp1Mxq1DZ04QQNummLqjI2VMxOuZJZkzCrNKKoD49kyR7v8y0zCyKHtUogKPAEqRKe42CSm9K8ZKopys9w0sqmTIlKaeFnVZqkjBJyvIjU6FymgovkGq0TC/2dfrpU6omyp4upGL0DDC6BDvKLcNO5UtzsEKIbK8JFfPLLV2uqMutWC3jS4jVdgqLLrykq666usDSLaet6IItV8xSW+695bZyiy+LtrUMMLzcAsvA1a4yMCy89CJMv+417PDDEEcs8cQUV2zxxRMFBAAh+QQJBADrACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6LlZaDpap8tr53xM5yzttv1+Vr3u1o4vNm5fZj5/lg6fxe6v1c6v1b6v5a6v5a6v5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5a6/5c6/5f6/5i7P5n7P5u7f507f537v567v587v5+7/6D7/6I8P6N8f6R8f6U8f6V8v6Y8v6Z8v6c8/6e8/6h8/6p9P+z9v/A9//H+P/R+f/a+v/g+//o/P/u/f/w/f/x/f/z/f/2/v/4/v/9/v/+/v/+/v/+/v/+/v/+/v/+/v/+/v/+/v/+/v/+//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDXCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzJs6fPn0CDCh1KtKjRo0iTKl3KtKnTp1CjKjx2TOrLYcOsugwmTGvLXV29rgQrdmzYsiiD/UKbUlgttiiHvWIG1+SxVsbqmowFTG9JYK/8kjRmqpjgka9uHRYJzFTVxR+ZtdIFGaSuVnQrdyTcV3PHWqYye9Z4zBTl0Rt1FUZN2lRg1hkbB4Od8ZVj2hcJx8J98ZeptbwrxlodfGJpU8UpCjO1O7lE1cCdQxx+VrpDU8StNyyGXfvD5a+9/jNs/FY8Q9XlzSsE3Vl9QvbuFQ5vH98gdvr1Cd7Pf3A//4L+/TdQgAKu04op+P0HWnQFgpZeg6Y8KGBjyBUoUDDY5WUhd6ZkZeE62DEo4HDNWahaaB8u1+GHx51m4XDhFeibKRoWyKGI/9nWyofrqFjdf8xgJ+F/Jxq2oZA8gpadgIRFyOOJP/J3l2uiTRgij7bR+CGHJcp4pYWSYRdlfk3ilSJ2mH14YixVEokdmx8Ox1yb+TEjJ5wF2vkmnfXpydxjBZ5opoUUmjKbhcIcGCGg/xkjZyuH2sToUIXGYqRMxXh4lDFZmrLLpCsd88ulSDEDjKKegmrXLrrweRQzizNitwupJB2zSy01PnXMiW8Go+pGzAgTyy20RnUMYNj1mitGxwizy2S/WjXMLcli98ouwSz7kDHO2hZLMK6WFewtqCYbSy2/AANMMewWw4wx7Q4DzC5yMucrasYEc0un1fbrbyu1ADNMuJ4xk6m6t9Si8MK13KJuMdHyKPHEFFds8cUYZ6zxxhxPFBAAIfkECQQA6QAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQkZGRkpKSjp2giqisgbnAecXQc8/cbNjmZ97uY+LzYOX3Xuf5XOj7W+n9Wur9Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wev+Wuv+W+v+Yuz+aOz+bO3+b+3+cu3+e+/+g/D+j/H+mPL+n/P+p/T+rfX+tPb+u/f+wvf+x/j+zfn+0fn+1fr+2fr/3Pr/4Pv/5Pz/6Pz/7Pz/8P3/8v3/9P3/9f7/9v7/+P7/+P7/+f7//f7//v7//v7//v7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A0wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4c+rcybOnz59AgzZUJtSnMl++jBXdaeyWLqJLcxqzZUtpVJzKctWyevUmL1i6uuI0RosWV7E0fbnKhdamsluugLWtqWyWq2FzaQ5zNQtq3ph7+/6VyYuv38Euea0SjPglsMWHG6/ce1eyS2OuVvmy3LLuKracWd5aRSs0S1+rXJ01bVJZ5rCsU9YiHTvl41V4a5+EtcqW7pO6Ukf+DdL1Z+IlcwlHPtI4aOYhg68aDp0jb9/VQd7Ond2jrVWwuv5/VLZqFWzxHBWvWo0e4+xZ7TuWPx8fI2rc9TWOdpVf46xVtfSXUXnPCUjRbXIZWJF03CkokXKrOFjRbOFJOBEttFkoEW+laRhReQF6CBGBIo54XIkOkYgiQ8OouKJCxrj4YkIyznhQedjZiFBmHep4EIY9+lgQhhEKadBo0xlZkHoJKinQbfQ5CaKTBGFYIZXpIMmekPfxgmU65PX2ZTr/8fclhE06GaOYX/6XJJbqeYmlcVdSCeFmWK4ZpJPfrZKmknqOieSfRtI5JoQFOlnmlj7eFiKWSEZZqJuECrnXcljexxiVSD5KJZE5OukZm1SOGqqSpn45Ki3U+djnLIkNKgmhK3JSqRaIrdpIVnmwVOojhL0xauMwRK71ZWG85pLri1llltotwjKbi7MA4ukkL0SCd0usPjbFG6+3+LJsQ8NE+9swt7hZ3iy25OKLrwUBw0sut/BiLnPKAKOVuuWBV9a//85SSy7AjJsfMPLmorDCvADD7ZgQRyzxxBRXbPHFGGessUYBAQAh+QQJBADqACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6Pj4+QkJCNlpiKnZ+ErLF+uMB3xdBxz9ts1uRn3O1j4fJg5fdd5/pb6fxa6v1Z6v5Z6v5Z6v5Z6v5Z6v5Z6/5Z6/5Z6/5Z6/5a6/5a6/5b6/5e6/5i6/5m7P5p7P5s7P5u7f5w7f5y7f507f517f537v547v567v5/7/6H8P6O8f6X8v6f8/6l9P6p9P6s9f6x9f+59v/B9//J+P/R+f/V+v/Z+v/b+v/d+//g+//k+//r/P/v/f/x/f/0/f/4/v/4/v/5/v/6/v/8/v/9/v/+/v////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDVCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6typrhmxYL52+QpGTBlPnT593aK1CxixZkd3NguWa1UuYEajSqVq6lYwqFp3KvO1ypSurGF1KtNlatUutGlxrm3rC2xcnM3ImrV796awV6ZeEeubsxkvU6Z28SVME1mttsIY4xRWlhYyyTeBIda1GHNMtmY92wTtS3RN0MFM00Steibp1jI1h4YNkxjiW7RhKiv7qnPulI9XXf7d0hdiYMRb2jaVK3lLwKt8Oydp3FTk6SmV3cauMhdiuNxJ/i7XFR4laPDlQ2qfnZ7k+fYkm5XFDX+k7NT1RULPLxLZZv4h7YLYcAB6BNgrBX603i4JeiQMYtc1uBFo0klIEWC0WLjRghpqtBxyHWIUDGKDhXhRdRWa6JB3pqh40S2BuWgRjPTJONF8NlKEWHM5SoRYaT1G9GOQQpoCJJEODYlkkswtyWSNTipEY5QMwYgglQoJ2CKWCaHIJUIPmlLilwWtdySZBJVFHpoFwVgLmwV5CadAy0U4p5JzqmNlngLJRiCczSDGIJ/eXZnniNbxqQ6OfL6X53pr5unonJAqOimcu3WlqGx2wklLWylS6V+TfFaHX54wCsdnprWEGuV4dpsKailip87JGp+fmlIrm8281uh/pd7mqpOUmVLLn2wi8+kqnaLZK2K8DLtksYLx+Sxz0iKpTKp18UlMqrygR+ZcZiGLpjLAfFrLV6umaxVWqwazyy2v8EKUoj/5oosuQxFjrqIAByzwwAQXbPDBCCes8MIXBQQAIfkECQQA6QAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQjZaYhKarfLe/dcTPcM7ba9XkZd7vYOP1Xeb5W+j8Wun9Wer+Wer+Wer+Wer+Wer+Wer+Wev+Wev+Wev+Wev+Wuv+W+v+Xuv+Yev+ZOz+Zez+Zuz+aOz+aez+a+z+be3+bu3+b+3+cO3+cu3+de3+ee7+fO7+fu/+ge/+hfD+ifD+kfH+m/L+pfT+rfX/tPb/u/f/wff/xfj/zfn/0/n/1/r/3vv/4vv/5fz/6Pz/7/3/8f3/8v3/9P3/+f7/+v7/+/7//f7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A0wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4XzozxrNnT2c5gxoD1isXrFJIkdrKxbRprqK/hCEL+hLZr1xJS9nq9YuYMYY7hQET9pXqSWW+jiKF5YsYULNUhWFd62sqXKrOfqkt1cvu3aB5VSFV9UvZX7PC1BJ+ezgnsrmlfjFujPNX0lyGKedUZmswMc1BiQkutWsy6Jq+BgM7jdMZL6V+WdN01rlULtOyY9JG2iu3zd18fdcE3ls4zdrFjcvshTSX8pmWteJ+vtLY4NjUWTob/Tn7y7m/vP6/JNZcvEtnR1VlNr8ydWT2LK1rhc9ybln6KJGVx5+Sean7/JWkzH4BmuQegAWOJBgsCZokDFLCNFgSVqpMJyFHAwZ3oUgHbihSZ6p4GJIzvIkIEnmlRGiiR+6tt+JGWDH4YkdI7TIjR/q9d6NG8iG4Y0XRufhjRe4NmRFWthiJEVbOKWnRUck5ORFS4UlJEZVWXqljlhFhyWWXW37pkJdijlmKL2U+1FmTaTLEZJsNpZYknAtFR+dCKAp5J0E5+rjnQGT+WRBWNgpqkGUhGlqQfNgpKthqihLE3JyRCvRgKRbuSWIpkFaazqSeCpRnqOkchWaoiGZ653ackmoZLIGq0slqlZ6mSiqUpPZI6i62kcpqp5WSpx6pzLFZ6W60VoqMYN15qp8qjRr6IKykPmhLrHRaiy2cwqhyLanLfhsqMrBA6+suqqgYKjBhKruUnorqBeyxRcFr6GO92CuoMVxtC6cyvxRGqkDIuDXwwQgnrPDCDDfs8MMQRyzxxBRDHBAAIfkECQQA6AAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQjZaYip2ff7C3d8LMcM7badjnZODxX+X3Xef6W+n8Wur+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wer+Wev+Wev+Wev+Wuv+W+v+Xev+YOv+Y+z+Zuz+aOz+a+3+bu3+ce3+c+7+du7+ee7+fO/+fu/+gO/+g/D+hvD+ivD+jPH+kPH+lfL+mvL+nvP+pfT+rPX+svX/tfb/t/b/wPf/x/j/zvn/1fr/3Pv/4/v/6Pz/6/z/7/3/8/3/9f7/+/7//P7//f7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A0QkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4WTo7ZgwYsFtAgwL9BWzYMWc5ayYbpuuVqadQo0qF+kqX0aQ6ielaNfXVLaLEjok9umxsT163oOoihhQrSa1SV+kCdoxiMmK/ZJla6/bjsl9cocoCloyjM2K8VgFb1jfjMV1RZQ1jHPKwLF6UG0tcxisqr7onOfNqq7mhM2CeM6f8C6w0Q2OBTWGGuWxYYdcGnUF+Kgu0zGSqccN+qhg31mGCbxvH2flp6+U4nc0irhx6zWWBZQW3LlM6b9LcZ/563ws+fMzxvMzb3C1Lfc1f393PJPb0VXn5LZNRx38+MDH+MTX3C4AwHcMbgS8545Qp1SGoEmqmDOigTlzZNyFLzf13oUrLPHXLhis15xuIJnVoyockogThiCmSxBWKLZZEnykaxkhSWqvYWJKJz+koEnKmbOdjR5C9MuRIT0l45EfGPGXMkiDBZwqUIKUFI5UcOYdlRyY+ueVGMwr5JUUQjrlRZ1eaaZGVamaUlpJtVpRWj3FSpGWdFd2J50R67hlRn34+BGigDTlFJ6ENzYkoRIou6hBkcDqqEGppSooQcpVaapCBU2q60FMNelqQXjWKalBnkZo6EH2zqHqQM5FP3eeqXl66ShB8qbqqn5G2FuSUmKbCN0yvBHXIK7ECdcairQamh6xAacmqqoGH9rqVtKZ26Oyz8AErqjNyPStQk8va+ouFzzozmLjoJLNKqLYSg+6zw2RqKy+53lsqsrzsS2y/7KIDMLvD+NtrMuXa6kytATfs8MMQRyzxxBRXbPHFGGes8cYcd+zxxyCH/HFAACH5BAkEAPAALAAAAACEAIQAhwAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj5CQkJGRkZKSkpOTk5SUlJWVlZaWlpeXl5OdnpCjpo2prIuyuIDDzXfP3HDY5mnf72Xj9GHm+F7o+1zp/Vrq/lnq/lnq/lnq/lnq/lnr/lnr/lnr/lnr/lrr/lvr/l7r/mDr/mPs/mfs/mrs/m7t/nDt/nLt/nTu/nfu/nru/n7v/oLv/obw/orw/ozw/o7x/pDx/pLx/pTx/pby/pny/pvy/p7z/qDz/6Lz/6X0/6z1/7P1/773/8b4/8/5/9b6/9r6/936/+D7/+L7/+T7/+b8/+j8/+v8//D9//T9//X+//f+//f+//z+//3+//7+//7+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wj+AOEJHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOFk+W6Zsl89YrIIGjeXzlzJmz3LOvMZsGC6hUKNKFYprGDNtSlU+Q/Z0qk9kysKKFetrFy2puJBJyzpSG7OzUdM6WwvxGTOuUGkpu8a247NhUWkNc4Y141a4rIbx7XtR2i6osdSGvLYM7i66jCNeAyx0F7OTf4MOK5y5oTKou5Kq1KYsVixlpRc+Q5z6pTbAuDDHHnhbKK3PMq/5YgV7t0BpQIMqIz1z9i7mjJlR1W2ztWrGnFkh6yvtd9/erGL+Af++a1lWbV1pUe+LbFhO9EFxQc/c9CZ8VvKND6xP876v+bsxM15MnOWnX0HMOCMTMvEBeCBhMEmHn4MHwrNYS9IMdWGFB1FYUlfrcbhgUOaJaNMzQe1iok3anBXLhivGdBorJcYokzZA4WIjTQyyEuKOK10jGpAycQYjkUEGtR2SL814JJMpneUelC05E9R1VKo0nI5ZrqQNiV2uJOGTYY60ZZkqAVUjmiVl6CObJ51GC5wnPTYlnSSdNSCeIH35Jp8iocgKoCNJxyWhIJ2mIqKJascoSMMV92hHj605qUaPYXlpRpluylGnnmLKiqahVvTYj6VGBGqqFg1HKqueEZ32KqwPyUprRSgqeOtEQkq6a0Sx3PkrRD4NK9FpxkZkJarJGvTlns0qlFa0Di1zKLUKCUkmtgThAi23BS0jLLjOsuIhuFaRm9A1i6p70C7bkvuXuwj5Ei+40oxLr0CK7VuQNkv6O9BcAhOka8EC3QvuuQg37PDDEEcs8cQUV2zxxRhnrPHGHHfs8ccghyzyyCSXbPLJKKes8sqABgQAIfkECQQA6gAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oi5WWiJuehqGlhKesfbW8dsLNcM3ZatblZtztY+HyX+X3Xef6W+n8Wur9Wer+Wer+Wer+Wer+Wer+Wev+Wev+Wev+Wev+Wuv+W+v+Xuv+Yev+Y+z+ZOz+Zez+Z+z+aOz+bu3+c+3+d+7+fO/+f+/+ge/+hO/+h/D+ivD+jPD+kPH+lPH+lfH+lvL+l/L+mPL+mfL+nfP+ofP+pfT+p/T+q/X+r/X+tPb+u/b+xPj/zvn/3vv/5fz/6fz/7f3/7v3/8P3/8v3/9P3/9/7//P7//f7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A1QkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzY/MlN3cuVAZsmC0aKkqRbQo0Ve0cBEzppNnzGjJgBqdSrVqrGDJnKpkFixWVaJBeREbSxZX0FdfcSGLplVkNGRep77CZSwZW4fKkhHDNdRor6xtOTIj1peoKl7ImGVURizuUWN3A1dk1msqL8AeB6M1TCyy5IfRghl9tbakMl5FVRn7/JBwUVqYT0ZzXepVbNYGkzmG7XJ2X1yecasLXdS2zGioS6m6/VlZXFXEbCqjRTRY8LbIfiveaWxorO2BRf4TXa2VGXVVTZ1Ge86cJzHl7WeuJxrrutZkQ5HtnF8KuHB1zpWiX0388fLfQOuhV1NcBh6IYCwKylRZKQ06+KAq9qn0HoUWGrReLDAlA1aHB0WjSjAuMeNdhh0qs1xL56VHYm6qgIfShgPOiBAxtKikDFEV6ogQLTma5NUrLAqpDjP1nYQMUfEpOZAx0ZVkIodSLoSLjSG9h2GWCzETJEhXVgmmQrxw6dF7r5zJ0GAjDWWmmwlBFtKTX9Kp0FshUYeingtFeREzRKkJaEHMJFmRaGMeWuJHaAnqKEg/tjlpSqL9eelJXhm6KZm1fXqSiJqKOtJ7kpqqES6lKKpqRqWxgPjqSFjOGlIpc9rakYip6koRr75+ZEwpwX70XrFrWorsRjwuy1GzzmoEbbQYGdMjtRglcy22Fk3HLUbbfktRuOJKJGu5E+GCLkXE9LpuQckU+W5Ds80bUan2MiRvvgox4ym/Bv0L8MAEF2zwwQgnrPDCDDfs8MMQRyzxxBRXbPHFGGes8cYcd+zxxyCHLPLIJJds8skop6zyyiy37PLLMMf8UkAAIfkECQQA7QAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQkZGRkpKSk5OTlJSUlZWVlpaWl5eXk52ekKOmh7G3fMPMcdLgadzsZOLzX+b5XOj8Wur9Wur+Wer+Wer+Wer+Wer+Wev+Wev+Wev+Wuv+W+v+Xev+X+v+Yev+Y+z+Z+z+aez+auz+bO3+cO3+c+3+du7+e+7+gO/+g+/+h/D+jPH+k/H+mfL+nfP+oPP+pPT+q/X+sfX+tvb+u/f+wff+xfj/yPj/yvj/zPn/0Pn/1fr/2fr/3fv/4Pv/4vv/6vz/7f3/8f3/9P3/+f7//f7//v7//v7//v7//v7//v7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A2wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4WUJLFgxYrlypggpN9epnr2DFlkHLKXNZMKBDo0qVOqtXsqVMUU4bBnVq0Z/Bwgbb9XPW1KCzgDnLOrLYLqm2ji6b5nDasmG/bFEdRpftRmi9Xg2dFSxZX4vTkv0yK/RVL6x+KwIe/GvtR2eBh/ZaFlniZKG5kpks1jXVLsidFw4THPSxys9Bg6VW6Exva9SvewmdxXl2wWCgcbeE1lW273bEg74SXTMZa1vCsy5jvetwzWlvifb2O0w5c6arg/4O86s7lS3LbJ0x7pW1fC/rbKdBZX9zmu1fx9u5v5m9WH6BwKVC30zl+fefQMW0NlOABh6IoHgxJRObgwX9EtR3LDkj2IAUDqTbK+ipZF8quXR40Fu2wHeSbimaaNCI+KkkIYguHqRhKhiWNI1gOdY4kISzqCiSbjH6eJCFxpUETSpBGonQNLO8Et1HQG3npEHLCFhSlrtcqdBbU3KUyytCeinQjhx+tGSSZh4EXJgZBVZmm+3syGZHa9Kp0C9kgtQdnHQu2WBHcem5UC9derRkiIYa5Ewqc1YUjC2NLpTLoBrZgmmlBbmFZ5+cPvlKR56GmtAuVmL0y6amDjTMnZ8X5QIop9AkqtEsrSpUokbLFJmrQb9EClExrP7azjCpSpqsse0sU6xEaTJ7JqwURSttO75aRK2020r0rLHjZbSstONKxOi17ZyL7rrstuvuu/DGK++89NZr77345qvvvvz26++/AAcs8MAEF2zwwQgnrPDCDDfs8MMQRyzxxBRXbPHFGGes8cYcd+zxxyCHLPLIJJds8skop6zyyixLHBAAIfkECQQA6wAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQkZGRkpKSk5OTlJSUlZWVlpaWl5eXlZ2elKOljLG3hL3Fd83Za9rpY+LzXub5W+j8Wur9Wer+Wer+Wer+Wuv+W+v+Xev+Xuv+Yev+Y+z+Zez+Z+z+aez+a+z+be3+b+3+cu3+dO3+du7+eO7+e+7+fu/+gO/+ge/+g/D+hvD+ifD+kPH+lvL+nPP+o/T+p/T+qvT+rfX+r/X+svX+tvb+uvb+v/f/wvf/x/j/0Pn/1fn/2fr/3vv/4vv/5fv/6Pz/6fz/8v3//f7//v7//v7//v7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A1wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4WTpTJuxXrlylggot9ernL2HLnOWcuUwY0KFQo0bN9UuZtKUppSHrpUoqLaPCwortlYuW1KC0fkXDOlJZL6iqeCFd6zBaU16vpiJj21GasLxCaRVTijHaMV5dhapSy/ei38SlBF/9uOzt0F50G0cUlnhxZpHSjgEOmmuZZofKAL8qNhmlsqdBf7U+bVAar6CqhM1WuQz2K2W0DSpL3Gt3y2VmSRvnK81yaZuccZs+7cysqmI5o8EWpnlZ11yfcf4KE9qL77Gg3BsPR7t85nlVwKknp9Ue5vlXhGlLe0rf5vn+wQ1kGYAyOaMKgQEKNGB9KRmIYIIKBsVLTNK88iCEEZbyC0yIMZhgcvGxVIwq+WFYm3XhneRMKSGaeNCKkbFES3ouJlQMeio5VSNDt5WSImiv/LgjQdJ8h1Iv2A25kDJBHWOSM7ko2RBQr3ioEXhSMhQNjiNVlmVD46li5UWYfclQkaXQ+FE0apqZ0HiviKSbm2d25SRIbdKJ0C+lRPmRM0LqSdCWPlImaENvbehRoIcOtAxRjbKUV4mRmsRnnpWOtKKfmZ6UV6co8UkpqCExmSSpI0lTSnmokvRVq5sk9RInrHKWQqtITI5560SPTrerR6X4+itHwQ7rES3CGpvRc8puxGyzyyYLbUXPTmtRtdZSlIuu2SbEabcUsQqutuNSxGa5vN6JLkTHjLruQqe+65C68jYkbb0IcYvvvvz26++/AAcs8MAEF2zwwQgnrPDCDDfs8MMQRyzxxBRXbPHFGGes8cYcd+zxxyCHLPLIJJds8skop9xvQAAh+QQJBADoACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6LlJaJm52GoaWBq7F8tLx4vMVxyNRr0d9m2elg4fNd5vlb6Pxa6v1Z6v5Z6v5Z6v5Z6v5a6/5c6/5d6/5e6/5f6/5h6/5j7P5n7P5q7P5u7f5y7f507f547v577v5+7/6A7/6C7/6G8P6J8P6L8P6O8f6S8f6U8f6X8v6b8v6e8/6i8/6p9P6w9f629v699/6/9/7C+P7E+P/I+P/M+f/P+f/T+f/Z+v/e+//j+//o/P/t/P/z/f/3/v/9/v/+/v/+/v/+/v////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDRCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhZLjPWixesn6CCCv0J6xavYclyzlwG7BYroVCjSh2qa5jSlcd0PY3KCtaur2DD6gI6lVavpFdFJtOVCiorXcCORUw2bKxUWMDSeix2S2iqqss01m0r1BSvwHovFoMVNNXZkMl2mYJ6C23iubSC3ip2EhhjobcQX2a4TBcoU7tEo1xcmNfohcMmh37JujHn1wVLg6JlGSYwwqBm40Z3jFWq2zR1BzUl9zUw1KprFtsKKu/lXqmaXzUdVFfiW7Ci/it9HpSW+Jq3vL8+NhkUq/Myb1nHvWzr+5vyhw+sH/Q+zfz6EdTXafCttMt8AQrEn3syHYNgggpudQtMyyAHIUEL9kLbhQixF5RVHNpUzHIFhtjSLuWZaNNWIKrYYGMlupgSiqDsIuNMhPV2Y0sjBrdjTANa+ONKyaQ4pEsD6ngkSkWCot6SK/VlCpQs9fgglSY9RQuWKvUSVIxcdtTklWGKpGWZJ6E4JZolHROUdmyKNJmGcY6U2ZZ1ioRiKnmK1GOfIgUlJKAbtTUooRkxZiOiHfW1KKMboTghpBt5CQulG414KaYZacppp6Bs+qlFno5KaqimnipqqhKN+CSrmBGN+CisEI1IJq2wgXIorgqhCCavAvIJ7EOs4DlsQ6DQeexCbu66LEHAgPIsQ7oYOy1CrNx6LTrLgPLrscBYu21BAI6b25rmFgTMrOkK5F+7AiUzKbwCVUZvvPPSq8u3w0Z2r0DK0nsMnPAq+e/BCCes8MIMN+zwwxBHLPHEFFds8cUYZ6zxxhx37PHHIIcs8sgkl2wysAEBACH5BAkEAOkALAAAAACEAIQAhwAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj5CQkJGRkZKSkpOTk5SUlJCanI+rroa+xn7M13jW4m7f72Tl91/o+1zq/Vvq/lrq/lnq/lnq/lnr/lrr/lvr/lzr/l7r/mDr/mPs/mbs/mrs/m3t/nHt/nPt/nXt/nbu/nju/nru/nzu/n/v/oLv/obw/ojw/ozw/o7x/pDx/pPx/pby/pry/p3z/qDz/qP0/qj0/qv1/671/7P2/7v3/8L3/8f4/8z5/9H5/937/+b8/+z8/+79//X+//j+//r+//r+//z+//7+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wj+ANMJHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOF0mQxYsGC5aQIPSwtWzGLJmOWk2OxaMFipRUKNKnRp1Fa1gyZKyXDYMVlRau4IdQ0Z2WTOyZIcF+0XL61RUuIoh1TqyWVdRsHYVyzoxWbFdq6biOkb347JdovTO1ZjsbtVgywpnRAZUrkiubqHuiiy5763NKJEhjvprcWeGzXaBXnk4Kqpgpk8fPPaLs8vWUFfxlW3w2O6YyDIH402wme2aw57i/U0c5zJaUFEVa053WNTh1JMmU74re9JlbmH+xfY+s1n48eRjmocqPr3N9Xjdv3fbXb5S+vaVKp+eX+Z2qMz111Ix0aEnoEq/QPXLgTG5hQyDLyGTG4QvJSgKdhSu1ExgqByXIUoEJvYhS9CJEuCIJEkoCi0oqlTigy2epGJ9MZoEHSoG1uhRiPzpSNJTq/hYkoUwChlSMgoaOVJgsCgp0mgeOrnRMVD1KCVHzSR5pUdeNbllRxZ+2RGVJoq5EZKiDGPmRlBhuOZFXt3yZkbQsTjnRYjZeWdFwYgS5J58QgVooKIMSlGfhRoqEaKKLipooxD1qSekDUlK6UOWXtoQdDRqqhB0bnqKUGBWinoQVEWaapCKqiZknZeVrRqUYKexDuQVYbUWBFWOplIJa64CJbggsAMFdmKry/hJ7EDWqblsOoHxKqqEtOaKWJSxZjkpsH0eq+oyqFRb6y44PptsqLni8iuwEnqr6iro1trUs+lsJ62nG6YKLC2l5vqLs8v+Ra/AzxIccL+1HoPrsmbRey+9EEcs8cQUV2zxxRhnrPHGHHfs8ccghyzyyCSrGhAAIfkECQQA6QAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Njo6Oj4+PkJCQkZGRjpeZi56ggq2ze7nCdcjUb9PgadzsYuP1X+f5Xej8W+n9Wur+Wur+Wer+Wer+W+v+XOv+Xuv+YOv+Yuv+ZOz+Z+z+a+3+b+3+c+7+du7+d+7+ee7+fO/+f+/+g/D+iPD+jPH+jvH+kfH+lfL+mPL+nfP+oPP+o/T+pfT+p/T+qvT+q/X+rfX+r/X+svX+tvb/wPf/x/j/zvn/0/n/2Pr/3Pr/4fv/5fv/6/z/7v3/8v3/+f7/+/7//f7//v7//v7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A0wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4ZSIzFsyXT5/BjBnLmZOZMV+zWMFaynRpKlBQo7Ka5csYM6IulQnr1UvYUIbGiPWqxSoqKFa5kGFNqUzZRWbEcj2FmiqX27V4CSKTGxWWsLyABRKTFdWUr6uB8SrLVQqqYcSJsTLrNdfU38h4ezUGBUstZqzKakX19XmtsbmwIJe+yYwwKFPEVhMVtpm0bJzIyoKydRsnM1hQWanuPVP02eHEYxoXnrzmcuTNXRqHFZ2m61zVZTLTHTs7TGaNTf559u7SWHDo5FH2goo9vUvXX92vVNaYlfyW60H1us/yqSn0/Ilknn4BqgQcKHcVaNKAtSiI0oEAOtgRMVDtJ2FJ/kV4oUbCQHXZhiExExyIIxmXIIkeUUggiiA1Rh2LH7kG40cdgtLdjBspUyGOHT31Io8ayQikRvmNN6RFA354ZEU6gtLekhZB9SOUFAE3JZUSAZcKlhUJyaVE+X05UX4nitkQmWZCFGaaD63J5plQvemQl3IqpGWdDFmJ50JPNbhnQjv+eRAyUAUj6EEDxnfoQG4uOpCejhJkyoqRpkMoKIo62mikZclSqUBNKqkpVBrW2eenlkKV6aKibflpqJiorldKqW8yM6mFlcpKK5u2gmLop62ieumqhwLnZ6XBgDLrq5PeGClwT0a6HnOVUlhKmYciY0opRi7KzFPE/rkdKKIeul0p5Qp6breHKsMKt59qS22kxpgSraO+lOLsosostWuawbCS7p/KyNLLv2IqY0st2IrLVcN7KkOMMAiLyUzFqGas8cYcd+zxxyCHLPLIJJdsspwBAQAh+QQJBADrACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6LlZaAqrB3usNwxtJqz91k2+xg4vRd5vlb6Pta6f1a6v5Z6v5Z6v5Z6v5a6/5a6/5c6/5d6/5e6/5f6/5h6/5j7P5l7P5n7P5r7P5u7f517v597/6E7/6M8P6R8f6U8f6Y8v6b8v6e8/6h8/6k9P6o9P6r9f6u9f6y9f639v669/6+9/7D+P7I+P7O+f7R+f7S+f7T+v7V+v7Y+v7Z+v7c+/7f+/7j+//m/P/q/P/r/f/t/f/v/f/w/f/4/v/7/v/8/v/9/v/+/v/+/v/+/v/+/v/+/v/+/v////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDXCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzpsFiwXbVevaq1KxjPowh/ykK1atauZEijDkyGixWpVLigSo3abFcqT1i1bj1a7JUnT6/Ejt2ZTBYpT6uMruXZrNbbVWrn4mzG6uyrZnp3BkPliVSvwDqbyfILGDHOXm9TFXOMs9hXw5RvNlt1tlbmm2bRfrZZi/FomrvOpjqN2i/rmalFv4652BOu2TH7epKLu2Wzy3l7pyx2V7jL2J6Ns9Q9WbnKZpGdr+x19rb0lJxJBb8uMplr7idD/m8H/9G7bPIkxaMnaf7VepLZ34+MvUu+SMKs7Ies3Vh/x2LV+fcRYasI6FFpnhjYEXW7KbhRM505uNFXBUqYkVmkWJgRguNp+FAwZ/Hm4UTmJTciRRGeSFFxKk7EWYUtRsRZgjHKeFaNESGII0Q67uhQjz4yBGSQCs1IJEOcoXLkQi8uqRCLTh70XZQFQeiJiVQOBKIn9WVJEC4heklQaP2J+ZWSYgpkpXtprsPgYW3W1uGShKGZ5paytLlOaM2lGV2bsVmXZnZlZgngeWKql2Z7eoYmYpaMtpndnEQyiGWW0IGlp26PUgnmlW0eCqOXzRCmnaRhphlal2IiyKaYc7G96mWsbc4ypZehyUolXwGKaVlhcHoJGVh97mqrJ7IU6uRgnqAS7K59kVKLskfW9VZaXibzyrWU4lhWYbV0G2NXnLGyC7U+UmWVuejW2EwwuMyyCiu1dOotvLXIQlQw7erp778AByzwwAQXbPDBCCdMUUAAIfkECQQA6wAsAAAAAIQAhACHAAAAAQEBAgICAwMDBAQEBQUFBgYGBwcHCAgICQkJCgoKCwsLDAwMDQ0NDg4ODw8PEBAQEREREhISExMTFBQUFRUVFhYWFxcXGBgYGRkZGhoaGxsbHBwcHR0dHh4eHx8fICAgISEhIiIiIyMjJCQkJSUlJiYmJycnKCgoKSkpKioqKysrLCwsLS0tLi4uLy8vMDAwMTExMjIyMzMzNDQ0NTU1NjY2Nzc3ODg4OTk5Ojo6Ozs7PDw8PT09Pj4+Pz8/QEBAQUFBQkJCQ0NDRERERUVFRkZGR0dHSEhISUlJSkpKS0tLTExMTU1NTk5OT09PUFBQUVFRUlJSU1NTVFRUVVVVVlZWV1dXWFhYWVlZWlpaW1tbXFxcXV1dXl5eX19fYGBgYWFhYmJiY2NjZGRkZWVlZmZmZ2dnaGhoaWlpampqa2trbGxsbW1tbm5ub29vcHBwcXFxcnJyc3NzdHR0dXV1dnZ2d3d3eHh4eXl5enp6e3t7fHx8fX19fn5+f39/gICAgYGBgoKCg4ODhISEhYWFhoaGh4eHiIiIiYmJioqKi4uLjIyMjY2Ni5SViZqdhKaqgK+2fLjAeL/Jc83ZbdjmaN/vZOT1YOf5Xen8W+r9Wur+Wur+Wer+Wer+Wer+Wev+Wev+Wev+Wev+Wev+Wuv+W+v+XOv+Xev+X+v+ZOz+aez+bu3+d+7+g+/+jPH+lvL+nvP+o/T+p/T+qfT+q/X+rPX+rvX+sfX+tfb+uPb+vff+v/f+wvf+xPj+yPj+zPj+z/n+0Pn+0vn+1Pn+1/r+2/r+4Pv/5fz/6fz/8f3/8/3/8/3/8/3/9P3/9P3/9f7/9v7/9/7/+v7/+/7//P7//v7/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CP4A1wkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4c+rcybOnz59Ag8pMBuyY0KDJatVKdvQntFqwijX1mQyWK6NTeSZzBQtaVp65WNn6unNrK6xkcdYilSttTl6qXnl1a/OYKlZo6c6E1kpVXr0x+ariBZgmX1KEC8s8nFgxTGisEDuOaZfU38krgZHyi/nl2lZzO7N0RUqW6JbJVJECdpplrs2hW6NsReqVbJXFSJGSehslLFKseqOEprqW8JNrVcU+HhIyKePMSb5WHn0k8efVR8oCnl1kMt28u/5/pA1LPMjXpJabz/h99XqP5N93nC6f4zHw9TcWz6/xFSlX/GW0FikBYpSbZQVa1B5rCVakG3QNTkSbaRFORBqAFUp0YYYSbacKhxENCCJEIo7oUIkmMoRiigqtyCJCLr5o0G+tyKjQhjYiRBuGORr0YI8GtQchkAIdGB6R6wzIFJIC+fchkwJFxiOSQkK5Di+6Mcikf+lZqVqNUGqGHZS/kbIkktDoNiWRWEoGZWRPMikmhUySZiaUB5YHpZ1nEnngmkDSthuUA9JJZGrAqZejnUcCud1/YepGHZKVDYqmoG3VqZueSJYJaI5lgsZkqIrKSOqluolK5DGCdoUkeoWlocmlKlr2CIxqpLTSp41b6TZmj9DY4qsru74YLK6sNMarLLiqUkupIxZTJnC5QMvhMbJEpqayzFnbEDTAZOsrK7IUG10xvOTSSzHmFlQMMLbAIqiatVy23jG81MKVK/z268q8urHCVS72NghNMQgnnLC3Vjbs8MMQRyzxxBRXbPHFHgUEACH5BAkEAOkALAAAAACEAIQAhwAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYyQkY2dn46orIu2vIjByYLM13zV4Xfb6XPf7m3j82rm92bo+2Lq/V/q/l3r/lvr/lrr/lrr/lrr/lrr/lvr/lvr/lzr/l7r/l/r/mDr/mHr/mPs/mbs/mns/mzt/m/t/nLt/nXu/nfu/nju/nvu/n3v/oPv/onw/o7x/pTy/pfy/p/z/qX0/rD1/rr3/sH3/sj4/s75/tT6/tj6/tz6/t77/uH7/+L7/+X8/+f8/+r8/+79//D9//L9//P9//P9//X+//b+//b+//n+//v+//z+//3+//7+//7+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wj+ANMJHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOHPq3Mmzp8+fQIMKHUq0qNGjSJMqXcq0qdOnUDXuUhZVJi9gVWPmwpUVZi5aXV9+DetyLFmWZs+qrAVWrUpYXN2iVIYql1yUwEphvWuyViuqfEnSrRW4JK9OuwqTlFUKsGKQxDrdeiySVidilCGXkpUZ5K1OvDp7VNYJlmiPlkOf3ni47WqNqC6/1oirE+HZGCOjwp0x9l7eFWvZBm5xV6dWxCuS7uQ4eURWnew6l2jZ9fSHuY5fj3i40/aInUD+f38IPe54hrAkn29omfP6hZ9Nv1cYfz790vYTfvae/+D+/v6FB6BB/w1IUIEGClRfggIJJx+D6T2YYCudWGdgeJMxCEx4iTFonGwMCscfgxRKeOFwHnLIYDoirphObO4luGF0K+6HGYOl4MdgdjRC2EkpK3aXYYLpNcZgdxYCSCGIBvJ4m4HK5GhkgiIOOWB3u5EYnmoGiphkfjxOOWBe4f0GYJThSTegMks+OeCSMZ4pS3isNJcfm3TaaR+endRpIDBLoqLnfLzk2Oeg7+1X4Z9LdmJef4qW0iFRxJgJEy+xhScLokABg8uNLhFjWXioTJrULbWAmpKo4WHIaVGHytBCi6ok8TJqeLNWJWorubyaGy6NdiILl1kRc0sptPTKETC3BFtKqnflMmcrtuRi6UO93MJYq5qqGZgy0rYKCy237NLLucAoc+65uNxCCyyZcruZsqfxgoss8XKr776oyILLtbMpw0suqMJi8MGwyHLLLbwQ6+LDEEcs8cQUV2zxxRhnfFFAACH5BAkEAOgALAAAAACEAIQAhwAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4ODg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEhISIiIiMjIyQkJCUlJSYmJicnJygoKCkpKSoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hISElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltbW1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5ubm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKioeRkoWXmn6nrXe1vXPCzW/N2mvV42jb6mXf8GLj9WDm+F7o+13p/Fvq/Vvq/lrq/lnq/lnq/lnq/lnr/lnr/lnr/lvr/lzr/l3r/l7r/l/r/mDr/mDr/mHr/mLs/mTs/mbs/mjs/mvt/m/t/nPt/nfu/nru/n3v/oDv/oDv/oHv/oLv/oPw/oXw/obw/o7x/pby/p3z/qLz/qb0/qz1/rT2/8H3/8z4/9T5/9n6/+H7/+n8/+/9//H9//P9//b+//n+//r+//v+//z+//3+//7+/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wj+ANEJHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOHPq3Mmzp8+fQIMKHUq0qNGjSJMqXcq0qdOnUKNKnUq1qtWrWLNq3cq1q9evYJMqCyvSGFmRws6CHDZM7cdeY91yNLZLbsddxexuNHZL78Zdbf1iNKZLcEZYZg1bDFZXcUVlquI6nrgL2GSKwWBdnmgMVOLNEF1ZBg1xl2bSD4OBkox6YTFQaVs3BPVLdsNbfW0v3KVK98Jfnn0nFAYqsHCDw2gfP5i89vKCyQs/J5g893SB1a8PzK4dHXft36/+h58O3Pp14NK191Le/RZ77bBgd0cHqnj316u7AwPlav4uUOld5wooo12HX17a7ZfKfPE1dl1noASjHyipsPZcg90lJ592//WnHYTOXfdfcA/W5+B0I372nIa9dBdfhQnWF+JzxqjCn4XHuQcKgtPt995z+J3GEo5K1UghjyypqJQy8UUIkzGxLdnkjC4JI6FYTZ4IUzBXGsVkfebJtEuXQ30JCixEwjQmUWaimdMuLQZVjI2g3JLmTMDY+VMwdGqZUzCuIJnTeiYCNUwqVNY0TJNOBsWXK8bNpAyhRxaFnpIu8VkfKHAdVUyDmKY0jI5nRnrUL6mo8sudIo26KaKCTikzImAnBUMqKLuEqlQxOoqma0bF9EInmIJCRdemrvQS5UXKCLPLgK/SipUxv0BbHyy9BENMRMUI0wujyAbDKlXBglufK7j9ou666+5yi7mbYmvqV82atum9+OYbb7a/njVMML/ogpu15+Kmyy/AzDvfwgw37PDDEEcs8cQUV0xRQAAh+QQJBADpACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6QlZaPoaSOrLCMtbuKvsWCytN709922+hy4PBu5PRq5/hm6Ppi6fxf6v1d6v5b6v5a6/5a6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5Z6/5b6/5d6/5e6/5f6/5h6/5i7P5k7P5l7P5m7P5q7P5t7f5v7f507f587v6B7/6F8P6O8f6V8v6d8/6m9P6r9P6x9f609f649v669v689v++9//A9//F+P/L+P/U+f/a+v/e+//n/P/p/P/s/P/3/v/7/v/9/v/+/v/+/v/+/v/+/v////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDTCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzJs6fPn0CDCh1KtKjRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1L16eyug6V3cXLcBhfhrv+LuTFTHDCYcYMIzTGSzFCXI4P1ops0BblgpYvD7SFTLNAW4k92/IrunFpz+lsmdYsa/VlU64pmyrm2Zip0JeL3fbMyxTqXL4916LlmZkpyJp1x3a8azdrU4UvIzNFXHPzwM875zYlyzMuU9g7/jLb21WZKVPkO9L22jzzx2LRtzJzZYr0R2a/uvbuLnJXeqz0LdeRMrls1Vsr8YWUy39UKRNgScogdxVwCJrES35W2VbfSczIwuBT85ninknDjBjVd+ippNpUw5wnIEnKtIKbU8jQZyJKxbiiXVPM1GJKhS3t4kqCStly3nou0VILkUcBZwqGLzHTypJKOVmgTMhMyaRQTlY3U5ZUFtXlli+1WMuOQDGDIi1kwtSiK0ja5SN1bcZkTCuw/WQMfSLWiSWetnxYU2/nhceTMrSY4gqUNkV4Xitx9sRMcyKiKRMvfNJi6U/F4GlKLn6eVIws54EXqk5qnucKYS4ZY+R5kLTMaJQxpCrKakrFvPrji0b94umnm943TK0unjoUM7z82pqgGBXjZKkLUoUfsabUwkuwEikzDC58PnrrVcY8q6pqxmB7kDKM4UItrMMYC+K2pcbLnS224MLLvfjmQq+88arG7FbF8KIrvwTzq1qkZxnzCy/6rluqLPTuMoy5cemF2sUYZ6zxxhx37PHHIH8UEAAh+QQJBADoACwAAAAAhACEAIcAAAABAQECAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6Pj4+MlZeKnJ6HoqWGrLF/vMR3ytZw1eJr3Otl4vNh5fhe6Ppc6fxb6f1a6v5a6v5Z6v5Z6v5Z6v5Z6v5Z6v5Z6/5Z6/5a6/5a6/5c6/5e6/5h6/5j7P5l7P5p7P5r7P5t7f5x7f517v557v587/6B7/6I8P6P8f6U8v6Z8v6f8/6l9P6w9f639v679/7A9/7K+f7U+v7Y+v/c+//h+//m/P/q/P/u/f/w/f/z/f/3/v/6/v/7/v/8/v/9/v/+/v/+/v/+/v////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8I/gDRCRxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzJs6fPn0CDCh1KtKjRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADCx5MuLDTYmiHaQSGlnFGX2ghZ9yFlnLGXGhvadyF7Kzmx47JArOMERgvs75+aUSGuWwuxRplmX3FkRbiscVocdx1eiyv1ottkbUlefWqzmGRrbq9kbhYX7I7+tIdVlZvjshKMe86TPtHW5+9/t6K7tGX967FSl3vqBz41lvnP+46zlV5+I/pSWfdFR/kLfpZKSfcSOkNiJUtpYQmEnwKUvVLKdSRVMwqryBHFTKv9DcSf+5JlUsp95GEYSmqTfUggCedCBtUw6xC4kofymJhU8jIAiJLNZaCC1S0lCJjSy3q6BQupayyIksPlqIfUvy9CBMvpZRS3FHmqTcTfFIiVWWIMGG5ZFBb3oTljkPpEiUtM9KEJZpAIYPgjTph+cqROg1jI5w7QRnlejj54qKVPgHzpy1pzuRmlKs0yFMxd65SIk2//GkbUU1CuJ1LuUWp5FHAZBglLpemVAyRUcpCZ1GV6hiqhKQWySdSisW8eeaUIk2nKYirJgUMlojicqpGw+jiaZS35MpUMf/d+oouvxQqETK/7DJskcVihQwvd94qiy68BOPsQcUEswsu2WrqHHe5THtrkbS0u8u7u7RLy5/rnsnLt1sV88st6tbrr6ar0LKLomUVA4wvu9zSLr23tpvLwMYaJvHEFFds8cUYZ6zxxmYFBAA7AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA',
            msg: null,
            msgText: '<em></em>',
            selector: null,
            speed: 'fast',
            start: undefined
        },
        state: {
            isDuringAjax: false,
            isInvalidPage: false,
            isDestroyed: false,
            isDone: false, // For when it goes all the way through the archive.
            isPaused: false,
            isBeyondMaxPage: false,
            currPage: 1
        },
        debug: false,
        behavior: undefined,
        binder: $(window), // used to cache the selector
        nextSelector: 'div.navigation a:first',
        navSelector: 'div.navigation',
        contentSelector: null, // rename to pageFragment
        extraScrollPx: 150,
        itemSelector: 'div.post',
        animate: false,
        pathParse: undefined,
        dataType: 'html',
        appendCallback: true,
        bufferPx: 40,
        errorCallback: function () { },
        infid: 0, //Instance ID
        pixelsFromNavToBottom: undefined,
        path: undefined, // Either parts of a URL as an array (e.g. ["/page/", "/"] or a function that takes in the page number and returns a URL
        prefill: false, // When the document is smaller than the window, load data until the document is larger or links are exhausted
        maxPage: undefined // to manually control maximum page (when maxPage is undefined, maximum page limitation is not work)
    };

    $.infinitescroll.prototype = {

        /*
            ----------------------------
            Private methods
            ----------------------------
            */

        // Bind or unbind from scroll
        _binding: function infscr_binding(binding) {

            var instance = this,
            opts = instance.options;

            opts.v = '2.0b2.120520';

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_binding_'+opts.behavior] !== undefined) {
                this['_binding_'+opts.behavior].call(this);
                return;
            }

            if (binding !== 'bind' && binding !== 'unbind') {
                this._debug('Binding value  ' + binding + ' not valid');
                return false;
            }

            if (binding === 'unbind') {
                (this.options.binder).unbind('smartscroll.infscr.' + instance.options.infid);
            } else {
                (this.options.binder)[binding]('smartscroll.infscr.' + instance.options.infid, function () {
                    instance.scroll();
                });
            }

            this._debug('Binding', binding);
        },

        // Fundamental aspects of the plugin are initialized
        _create: function infscr_create(options, callback) {

            // Add custom options to defaults
            var opts = $.extend(true, {}, $.infinitescroll.defaults, options);
            this.options = opts;
            var $window = $(window);
            var instance = this;

            // Validate selectors
            if (!instance._validate(options)) {
                return false;
            }

            // Validate page fragment path
            var path = $(opts.nextSelector).attr('href');
            if (!path) {
                this._debug('Navigation selector not found');
                return false;
            }

            // Set the path to be a relative URL from root.
            opts.path = opts.path || this._determinepath(path);

            // contentSelector is 'page fragment' option for .load() / .ajax() calls
            opts.contentSelector = opts.contentSelector || this.element;

            // loading.selector - if we want to place the load message in a specific selector, defaulted to the contentSelector
            opts.loading.selector = opts.loading.selector || opts.contentSelector;

            // Define loading.msg
            opts.loading.msg = opts.loading.msg || $('<div style="display: none" id="infscr-loading">загрузка<div>' + opts.loading.msgText + '</div></div>');

            // Preload loading.img
            (new Image()).src = opts.loading.img;

            // distance from nav links to bottom
            // computed as: height of the document + top offset of container - top offset of nav link
            if(opts.pixelsFromNavToBottom === undefined) {
                opts.pixelsFromNavToBottom = $(document).height() - $(opts.navSelector).offset().top;
                this._debug('pixelsFromNavToBottom: ' + opts.pixelsFromNavToBottom);
            }

            var self = this;

            // determine loading.start actions
            opts.loading.start = opts.loading.start || function() {
                $(opts.navSelector).hide();
                opts.loading.msg
                .appendTo(opts.loading.selector)
                .show(opts.loading.speed, $.proxy(function() {
                    this.beginAjax(opts);
                }, self));
            };

            // determine loading.finished actions
            opts.loading.finished = opts.loading.finished || function() {
                if (!opts.state.isBeyondMaxPage)
                    opts.loading.msg.fadeOut(opts.loading.speed);
            };

            // callback loading
            opts.callback = function(instance, data, url) {
                if (!!opts.behavior && instance['_callback_'+opts.behavior] !== undefined) {
                    instance['_callback_'+opts.behavior].call($(opts.contentSelector)[0], data, url);
                }

                if (callback) {
                    callback.call($(opts.contentSelector)[0], data, opts, url);
                }

                if (opts.prefill) {
                    $window.bind('resize.infinite-scroll', instance._prefill);
                }
            };

            if (options.debug) {
                // Tell IE9 to use its built-in console
                if (Function.prototype.bind && (typeof console === 'object' || typeof console === 'function') && typeof console.log === 'object') {
                    ['log','info','warn','error','assert','dir','clear','profile','profileEnd']
                        .forEach(function (method) {
                            console[method] = this.call(console[method], console);
                        }, Function.prototype.bind);
                }
            }

            this._setup();

            // Setups the prefill method for use
            if (opts.prefill) {
                this._prefill();
            }

            // Return true to indicate successful creation
            return true;
        },

        _prefill: function infscr_prefill() {
            var instance = this;
            var $window = $(window);

            function needsPrefill() {
                return ( $(instance.options.contentSelector).height() <= $window.height() );
            }

            this._prefill = function() {
                if (needsPrefill()) {
                    instance.scroll();
                }

                $window.bind('resize.infinite-scroll', function() {
                    if (needsPrefill()) {
                        $window.unbind('resize.infinite-scroll');
                        instance.scroll();
                    }
                });
            };

            // Call self after setting up the new function
            this._prefill();
        },

        // Console log wrapper
        _debug: function infscr_debug() {
            if (true !== this.options.debug) {
                return;
            }

            if (typeof console !== 'undefined' && typeof console.log === 'function') {
                // Modern browsers
                // Single argument, which is a string
                if ((Array.prototype.slice.call(arguments)).length === 1 && typeof Array.prototype.slice.call(arguments)[0] === 'string') {
                    console.log( (Array.prototype.slice.call(arguments)).toString() );
                } else {
                    console.log( Array.prototype.slice.call(arguments) );
                }
            } else if (!Function.prototype.bind && typeof console !== 'undefined' && typeof console.log === 'object') {
                // IE8
                Function.prototype.call.call(console.log, console, Array.prototype.slice.call(arguments));
            }
        },

        // find the number to increment in the path.
        _determinepath: function infscr_determinepath(path) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_determinepath_'+opts.behavior] !== undefined) {
                return this['_determinepath_'+opts.behavior].call(this,path);
            }

            if (!!opts.pathParse) {

                this._debug('pathParse manual');
                return opts.pathParse(path, this.options.state.currPage+1);

            } else if (path.match(/^(.*?)\b2\b(.*?$)/)) {
                path = path.match(/^(.*?)\b2\b(.*?$)/).slice(1);

                // if there is any 2 in the url at all.
            } else if (path.match(/^(.*?)2(.*?$)/)) {

                // page= is used in django:
                // http://www.infinite-scroll.com/changelog/comment-page-1/#comment-127
                if (path.match(/^(.*?page=)2(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)2(\/.*|$)/).slice(1);
                    return path;
                }

                path = path.match(/^(.*?)2(.*?$)/).slice(1);

            } else {

                // page= is used in drupal too but second page is page=1 not page=2:
                // thx Jerod Fritz, vladikoff
                if (path.match(/^(.*?page=)1(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)1(\/.*|$)/).slice(1);
                    return path;
                } else {
                    this._debug("Sorry, we couldn't parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.");
                    // Get rid of isInvalidPage to allow permalink to state
                    opts.state.isInvalidPage = true;  //prevent it from running on this page.
                }
            }
            this._debug('determinePath', path);
            return path;

        },

        // Custom error
        _error: function infscr_error(xhr) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_error_'+opts.behavior] !== undefined) {
                this['_error_'+opts.behavior].call(this,xhr);
                return;
            }

            if (xhr !== 'destroy' && xhr !== 'end') {
                xhr = 'unknown';
            }

            this._debug('Error', xhr);

            if (xhr === 'end' || opts.state.isBeyondMaxPage) {
                this._showdonemsg();
            }

            opts.state.isDone = true;
            opts.state.currPage = 1; // if you need to go back to this instance
            opts.state.isPaused = false;
            opts.state.isBeyondMaxPage = false;
            this._binding('unbind');

        },

        // Load Callback
        _loadcallback: function infscr_loadcallback(box, data, url) {
            var opts = this.options,
            callback = this.options.callback, // GLOBAL OBJECT FOR CALLBACK
            result = (opts.state.isDone) ? 'done' : (!opts.appendCallback) ? 'no-append' : 'append',
            frag;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_loadcallback_'+opts.behavior] !== undefined) {
                this['_loadcallback_'+opts.behavior].call(this,box,data,url);
                return;
            }

            switch (result) {
                case 'done':
                    this._showdonemsg();
                    return false;

                case 'no-append':
                    if (opts.dataType === 'html') {
                        data = '<div>' + data + '</div>';
                        data = $(data).find(opts.itemSelector);
                    }

                    // if it didn't return anything
                    if (data.length === 0) {
                        return this._error('end');
                    }

                    break;

                case 'append':
                    var children = box.children();
                    // if it didn't return anything
                    if (children.length === 0) {
                        return this._error('end');
                    }

                    // use a documentFragment because it works when content is going into a table or UL
                    frag = document.createDocumentFragment();
                    while (box[0].firstChild) {
                        frag.appendChild(box[0].firstChild);
                    }

                    this._debug('contentSelector', $(opts.contentSelector)[0]);
                    $(opts.contentSelector)[0].appendChild(frag);
                    // previously, we would pass in the new DOM element as context for the callback
                    // however we're now using a documentfragment, which doesn't have parents or children,
                    // so the context is the contentContainer guy, and we pass in an array
                    // of the elements collected as the first argument.

                    data = children.get();
                    break;
            }

            // loadingEnd function
            opts.loading.finished.call($(opts.contentSelector)[0],opts);

            // smooth scroll to ease in the new content
            if (opts.animate) {
                var scrollTo = $(window).scrollTop() + $(opts.loading.msg).height() + opts.extraScrollPx + 'px';
                $('html,body').animate({ scrollTop: scrollTo }, 800, function () { opts.state.isDuringAjax = false; });
            }

            if (!opts.animate) {
                // once the call is done, we can allow it again.
                opts.state.isDuringAjax = false;
            }

            callback(this, data, url);

            if (opts.prefill) {
                this._prefill();
            }
        },

        _nearbottom: function infscr_nearbottom() {

            var opts = this.options,
            pixelsFromWindowBottomToBottom = 0 + $(document).height() - (opts.binder.scrollTop()) - $(window).height();

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_nearbottom_'+opts.behavior] !== undefined) {
                return this['_nearbottom_'+opts.behavior].call(this);
            }

            this._debug('math:', pixelsFromWindowBottomToBottom, opts.pixelsFromNavToBottom);

            // if distance remaining in the scroll (including buffer) is less than the orignal nav to bottom....
            return (pixelsFromWindowBottomToBottom - opts.bufferPx < opts.pixelsFromNavToBottom);

        },

        // Pause / temporarily disable plugin from firing
        _pausing: function infscr_pausing(pause) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_pausing_'+opts.behavior] !== undefined) {
                this['_pausing_'+opts.behavior].call(this,pause);
                return;
            }

            // If pause is not 'pause' or 'resume', toggle it's value
            if (pause !== 'pause' && pause !== 'resume' && pause !== null) {
                this._debug('Invalid argument. Toggling pause value instead');
            }

            pause = (pause && (pause === 'pause' || pause === 'resume')) ? pause : 'toggle';

            switch (pause) {
                case 'pause':
                    opts.state.isPaused = true;
                break;

                case 'resume':
                    opts.state.isPaused = false;
                break;

                case 'toggle':
                    opts.state.isPaused = !opts.state.isPaused;
                break;
            }

            this._debug('Paused', opts.state.isPaused);
            return false;

        },

        // Behavior is determined
        // If the behavior option is undefined, it will set to default and bind to scroll
        _setup: function infscr_setup() {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_setup_'+opts.behavior] !== undefined) {
                this['_setup_'+opts.behavior].call(this);
                return;
            }

            this._binding('bind');

            return false;

        },

        // Show done message
        _showdonemsg: function infscr_showdonemsg() {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_showdonemsg_'+opts.behavior] !== undefined) {
                this['_showdonemsg_'+opts.behavior].call(this);
                return;
            }

            opts.loading.msg
            .find('img')
            .hide()
            .parent()
            .find('div').html(opts.loading.finishedMsg).animate({ opacity: 1 }, 2000, function () {
                $(this).parent().fadeOut(opts.loading.speed);
            });

            // user provided callback when done
            opts.errorCallback.call($(opts.contentSelector)[0],'done');
        },

        // grab each selector option and see if any fail
        _validate: function infscr_validate(opts) {
            for (var key in opts) {
                if (key.indexOf && key.indexOf('Selector') > -1 && $(opts[key]).length === 0) {
                    this._debug('Your ' + key + ' found no elements.');
                    return false;
                }
            }

            return true;
        },

        /*
            ----------------------------
            Public methods
            ----------------------------
            */

        // Bind to scroll
        bind: function infscr_bind() {
            this._binding('bind');
        },

        // Destroy current instance of plugin
        destroy: function infscr_destroy() {
            this.options.state.isDestroyed = true;
            this.options.loading.finished();
            return this._error('destroy');
        },

        // Set pause value to false
        pause: function infscr_pause() {
            this._pausing('pause');
        },

        // Set pause value to false
        resume: function infscr_resume() {
            this._pausing('resume');
        },

        beginAjax: function infscr_ajax(opts) {
            var instance = this,
                path = opts.path,
                box, desturl, method, condition;

            // increment the URL bit. e.g. /page/3/
            opts.state.currPage++;

            // Manually control maximum page
            if ( opts.maxPage !== undefined && opts.state.currPage > opts.maxPage ){
                opts.state.isBeyondMaxPage = true;
                this.destroy();
                return;
            }

            // if we're dealing with a table we can't use DIVs
            box = $(opts.contentSelector).is('table, tbody') ? $('<tbody/>') : $('<div/>');

            desturl = (typeof path === 'function') ? path(opts.state.currPage) : path.join(opts.state.currPage);
            instance._debug('heading into ajax', desturl);

            method = (opts.dataType === 'html' || opts.dataType === 'json' ) ? opts.dataType : 'html+callback';
            if (opts.appendCallback && opts.dataType === 'html') {
                method += '+callback';
            }

            switch (method) {
                case 'html+callback':
                    instance._debug('Using HTML via .load() method');
                    box.load(desturl + ' ' + opts.itemSelector, undefined, function infscr_ajax_callback(responseText) {
                        instance._loadcallback(box, responseText, desturl);
                    });

                    break;

                case 'html':
                    instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
                    $.ajax({
                        // params
                        url: desturl,
                        dataType: opts.dataType,
                        complete: function infscr_ajax_callback(jqXHR, textStatus) {
                            condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === 'success' || textStatus === 'notmodified');
                            if (condition) {
                                instance._loadcallback(box, jqXHR.responseText, desturl);
                            } else {
                                instance._error('end');
                            }
                        }
                    });

                    break;
                case 'json':
                    instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
                    $.ajax({
                        dataType: 'json',
                        type: 'GET',
                        url: desturl,
                        success: function (data, textStatus, jqXHR) {
                            condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === 'success' || textStatus === 'notmodified');
                            if (opts.appendCallback) {
                                // if appendCallback is true, you must defined template in options.
                                // note that data passed into _loadcallback is already an html (after processed in opts.template(data)).
                                if (opts.template !== undefined) {
                                    var theData = opts.template(data);
                                    box.append(theData);
                                    if (condition) {
                                        instance._loadcallback(box, theData);
                                    } else {
                                        instance._error('end');
                                    }
                                } else {
                                    instance._debug('template must be defined.');
                                    instance._error('end');
                                }
                            } else {
                                // if appendCallback is false, we will pass in the JSON object. you should handle it yourself in your callback.
                                if (condition) {
                                    instance._loadcallback(box, data, desturl);
                                } else {
                                    instance._error('end');
                                }
                            }
                        },
                        error: function() {
                            instance._debug('JSON ajax request failed.');
                            instance._error('end');
                        }
                    });

                    break;
            }
        },

        // Retrieve next set of content items
        retrieve: function infscr_retrieve(pageNum) {
            pageNum = pageNum || null;

            var instance = this,
            opts = instance.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['retrieve_'+opts.behavior] !== undefined) {
                this['retrieve_'+opts.behavior].call(this,pageNum);
                return;
            }

            // for manual triggers, if destroyed, get out of here
            if (opts.state.isDestroyed) {
                this._debug('Instance is destroyed');
                return false;
            }

            // we dont want to fire the ajax multiple times
            opts.state.isDuringAjax = true;

            opts.loading.start.call($(opts.contentSelector)[0],opts);
        },

        // Check to see next page is needed
        scroll: function infscr_scroll() {

            var opts = this.options,
            state = opts.state;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['scroll_'+opts.behavior] !== undefined) {
                this['scroll_'+opts.behavior].call(this);
                return;
            }

            if (state.isDuringAjax || state.isInvalidPage || state.isDone || state.isDestroyed || state.isPaused) {
                return;
            }

            if (!this._nearbottom()) {
                return;
            }

            this.retrieve();

        },

        // Toggle pause value
        toggle: function infscr_toggle() {
            this._pausing();
        },

        // Unbind from scroll
        unbind: function infscr_unbind() {
            this._binding('unbind');
        },

        // update options
        update: function infscr_options(key) {
            if ($.isPlainObject(key)) {
                this.options = $.extend(true,this.options,key);
            }
        }
    };


    /*
        ----------------------------
        Infinite Scroll function
        ----------------------------

        Borrowed logic from the following...

        jQuery UI
        - https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js

        jCarousel
        - https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js

        Masonry
        - https://github.com/desandro/masonry/blob/master/jquery.masonry.js

*/

    $.fn.infinitescroll = function infscr_init(options, callback) {


        var thisCall = typeof options;

        switch (thisCall) {

            // method
            case 'string':
                var args = Array.prototype.slice.call(arguments, 1);

                this.each(function () {
                    var instance = $.data(this, 'infinitescroll');

                    if (!instance) {
                        // not setup yet
                        // return $.error('Method ' + options + ' cannot be called until Infinite Scroll is setup');
                        return false;
                    }

                    if (!$.isFunction(instance[options]) || options.charAt(0) === '_') {
                        // return $.error('No such method ' + options + ' for Infinite Scroll');
                        return false;
                    }

                    // no errors!
                    instance[options].apply(instance, args);
                });

            break;

            // creation
            case 'object':

                this.each(function () {

                var instance = $.data(this, 'infinitescroll');

                if (instance) {

                    // update options of current instance
                    instance.update(options);

                } else {

                    // initialize new instance
                    instance = new $.infinitescroll(options, callback, this);

                    // don't attach if instantiation failed
                    if (!instance.failed) {
                        $.data(this, 'infinitescroll', instance);
                    }

                }

            });

            break;

        }

        return this;
    };



    /*
     * smartscroll: debounced scroll event for jQuery *
     * https://github.com/lukeshumard/smartscroll
     * Based on smartresize by @louis_remi: https://github.com/lrbabe/jquery.smartresize.js *
     * Copyright 2011 Louis-Remi & Luke Shumard * Licensed under the MIT license. *
     */

    var event = $.event,
    scrollTimeout;

    event.special.smartscroll = {
        setup: function () {
            $(this).bind('scroll', event.special.smartscroll.handler);
        },
        teardown: function () {
            $(this).unbind('scroll', event.special.smartscroll.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
            args = arguments;

            // set correct event type
            event.type = 'smartscroll';

            if (scrollTimeout) { clearTimeout(scrollTimeout); }
            scrollTimeout = setTimeout(function () {
                $(context).trigger('smartscroll', args);
            }, execAsap === 'execAsap' ? 0 : 100);
        }
    };

    $.fn.smartscroll = function (fn) {
        return fn ? this.bind('smartscroll', fn) : this.trigger('smartscroll', ['execAsap']);
    };

}));
