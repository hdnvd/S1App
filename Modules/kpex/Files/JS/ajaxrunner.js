
let Message="";
let LastId=0;
let AllCount=0;
let Progress=0;
let PrecisionSum=0;
let StartTime=0;
let EndTime=0;
function getTime() {
    const dt = new Date();
    const theTime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    return theTime;
}
function getTimeInSeconds() {
    const dt = new Date();
    return Number(dt.getHours()) *3600+ Number(dt.getMinutes())*60+Number(dt.getSeconds());
}
function RunTests(testidFrom,testidTo) {
    Message="<p>Started Testing...</p>";
    LastId=testidTo;
    AllCount=(testidTo-testidFrom)/5+1;
    StartTime=getTimeInSeconds();
    EndTime=0;
    Progress=0;
    PrecisionSum=0;
    $("#logbox").addClass('logbox');
    AddMessage(Message);
    StartService();
    RunTest(Number(testidFrom));

}
function AddMessage(Text) {

    Message = Message +"<p>"+getTime()+"&nbsp;"+Text+"</p>";
    RefreshMessage();
}
function RefreshMessage() {


    let thePercentage=Math.round((Progress/AllCount) * 100);
    let theAveragePrecision=Math.round((PrecisionSum/Progress) * 1000)/1000;
    let Info="<p>"+" Progress:"+Progress+"/"+AllCount+" ("+thePercentage+"%) AveragePrecision:"+theAveragePrecision;
    let ElapsedSeconds=Number(Number(getTimeInSeconds())-Number(StartTime));
    let ElapsedHours=Math.floor(ElapsedSeconds/3600);
    ElapsedSeconds=ElapsedSeconds-ElapsedHours*3600;
    let ElapsedMinutes=Math.floor(ElapsedSeconds/60);
    ElapsedSeconds=ElapsedSeconds-ElapsedMinutes*60;
    Info=Info+" ElapsedTime: "+ ElapsedHours+":"+ElapsedMinutes+":"+ElapsedSeconds;
    Info=Info+"</p>";

    $("#logbox").html(Info+Message);
}
function StartService() {
    let timer=window.setInterval(function(){
        if(EndTime==0)
            RefreshMessage();
        else
            timer.clearInterval();
    }, 1000);
}
function RunTest(testid) {
    AddMessage("Testing " + testid + "...");
        $.post("/json/fa/kpex/managetests.jsp?run&id=" + testid, {id: testid, run: true}, function (data) {
            Progress=Progress+1;
            AddMessage("Testing " + testid + " Established with precision " + data.precision);
            PrecisionSum=Number(PrecisionSum)+Number(data.precision);
            if(Number(testid)<Number(LastId))
                RunTest(Number(testid)+5);
            else
            {
                EndTime=getTimeInSeconds();
                AddMessage("Testing Completed.");
            }
        }, "json");


}