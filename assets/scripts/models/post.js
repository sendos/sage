'use strict';

import Chap from '../chap'

export default class Post extends Chap.Model {
  constructor(attributes, options) {
    super(attributes, options)
    this.jsonURL = options.jsonURL
  }

  url() {
    return this.jsonURL
  }

  parse(data) {
    data.title = data.title.rendered
    data.excerpt = data.excerpt.rendered
    data.content = data.content.rendered
    return data
  }
}