app.service("APIService", function ($http) {

  this.get = function (url) {
    return $http.get(url);
  };

  this.post = function(url, data) {
  return $http.post(url, data, {
    headers: { 'Content-Type': 'application/json' }
  });
};


});
