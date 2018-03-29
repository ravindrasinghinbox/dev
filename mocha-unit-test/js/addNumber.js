/**
 * Function will add any number of
 * of argument
 * 
 *  @param {mixed} depends on what argument contain
 *  @return {number} calculated number
 */
function addNumber()
{
    var output = 0;
    var args = arguments;
    for(var i = 0; i < args.length; i++)
    {
        output +=Number(args[i]);
    }
    return output;
}