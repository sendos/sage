'use strict';

import View from './view'
import template from '../../../templates/content.mustache'
import entryMetaPartial from '../../../templates/entry-meta.mustache'
var partials = {
  'entry-meta': entryMetaPartial
}

export default class PostView extends View {
  constructor(options) {
    super(options)
    this.template = template
    this.partials = partials
  }
}