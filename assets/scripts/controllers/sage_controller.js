'use strict'

import Chap from '../chap';
import Post from '../models/post';
import PostSingleView from '../views/post-single-view';
import PostCollection from '../models/post-collection';
import PostCollectionView from '../views/post-collection-view';

// Here use commonjs/es5 to be compatible with chalin's controller autoloading.
module.exports = Chap.Controller.extend({
  home: function (params, route, options) {
    var collection = new PostCollection();
    var collectionView = new PostCollectionView({
      collection: collection,
      el: $('main').html('')
    });    
    collection.fetch();
  },

  post: function (params, route, options) {
    // If the json url isn't in the options, try to get it from storage.
    if (!options.jsonURL) {
      var storedURL = window.sessionStorage.getItem(params.id);
      if (storedURL) {
        options.jsonURL = storedURL;
      } else {
        window.location = params.id;
        return;
      }
    }

    // Store the json url.
    window.sessionStorage.setItem(params.id, options.jsonURL);

    var post = new Post({}, {
      id: params.id,
      jsonURL: options.jsonURL
    });

    post.fetch({
      success: function() {
        var postView = new PostSingleView({
          model: post,
          el: $('main')
        });
        postView.render();
      }
    });
  }
});