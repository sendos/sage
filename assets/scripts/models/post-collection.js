'use strict'

import Chap from '../chap'
import Post from './post'

export default class PostCollection extends Chap.Collection {
  constructor(models, options) {
    super(models, options)
    this.model = Post
  }

  url() {
    return '/wp-json/wp/v2/posts'
  }
}