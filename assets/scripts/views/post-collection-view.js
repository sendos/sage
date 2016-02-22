'use strict'

import Chap from '../chap'
import PostView from './post-view'

export default class PostCollectionView extends Chap.CollectionView {
  constructor(options) {
    super(options)
    this.itemView = PostView
  }
}