$leighUsercode = 'UCvXhifekQM6SjjSeEr51Eog';
$rgUsercode = 'UCa8OpQMvqIgAOhQ3I4A6Q9Q';

var app = angular.module('youTubeDisplayApp', []);
app.controller('youTubeDisplayController', function($scope, $http){
    var dataurl ='https://gdata.youtube.com/feeds/api/users/' + $leighUsercode + '/uploads?v=2&alt=json';
    console.log('connecting to ' + dataurl);

    $http.get(dataurl).success(function(data, status, headers, config) {
        $scope.vids = data;
        $scope.gamingVids = [];
        $scope.otherVids = [];
        angular.forEach(data.feed.entry, function(entryItem){
            //console.log(entryItem);
            var gamingVideoFound = false;
            angular.forEach(entryItem.category, function(categoryEntry){
               //console.log(categoryEntry);
                if (categoryEntry.label === "Gaming"){
                    gamingVideoFound = true;
                }
            });
            if (gamingVideoFound){
                //console.log(entryItem);
                $scope.gamingVids.push(entryItem);
            }
            else{
                $scope.otherVids.push(entryItem);
            }
        });
    }).error(function(){
        $scope.vids = "error";
    })
});
app.directive('myYoutube', function($sce) {
    return {
        restrict: 'EA',
        scope: { code:'=' },
        replace: true,
        template: '<div><iframe class="youTubeFrame" style="overflow:hidden;height:300px;max-width:100%" width="100%" height="300px" src="{{url}}" frameborder="0" allowfullscreen></iframe></div>',
        link: function (scope) {
            scope.$watch('code', function (newVal) {
                if (newVal) {
                    scope.url = $sce.trustAsResourceUrl("http://www.youtube.com/embed/" + newVal);
                }
            });
        }
    };
});
app.filter('filterOnGame', function(){
   return function(vid, gameName){
       var filteredGameItems = [];
       //console.log(gameName);
       angular.forEach(vid, function(video){
           //console.log(video);
           if (video.title.$t.toLowerCase().search(gameName.toLowerCase()) != -1){
               //console.log('match found');
               filteredGameItems.push(video);
           }
       });
       return filteredGameItems;
   };
});