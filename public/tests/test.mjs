import test from 'ava';
import {calculate} from "../js/script.js";




test('calculate1', t => {
    if(calculate()=== 10) {
        t.pass();
    }
    else {
        t.fail("calculate failed");
    }
});
