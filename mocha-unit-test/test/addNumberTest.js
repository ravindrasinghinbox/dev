var assert = chai.assert;

describe('Add Number',function(){
   it('Should add two number',function(){
        var output = addNumber(1,2);
        assert.equal(3,output);
   });
   it('Should add three number',function(){
        var output = addNumber(1,2,3);
        assert.equal(6,output);
   });
   it('Should add n number of argument',function(){
        var output = addNumber(1,2,3,4,5,6);
        assert.equal(21,output);
   });
   it('Should add number or string format',function(){
        var output = addNumber(1,"2",'3',4,5,'6');
        assert.equal(21,output);
   });
   it('Should add any real number or string format number',function(){
        var output = addNumber(1,"2",'3',4,5,'6','1.4',4.6,'0',true,false);
        assert.equal(28,output);
   });
   it('Should not add number which is NaN',function(){
        var output = addNumber(1,"2",'3',4,5,'6','1.4',4.6,'NaN','');
        assert.isNaN(output);
   });
});