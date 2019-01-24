<template>
  <div id="main" class="row no-gutters">
    <div id="sidebar" class="col-md-3 border-right">
      <!-- sorting tools -->
      <div class="toolbar border-bottom py-2">
        <div class="container-fluid">
          <div class="float-left">
            
            <!-- sort by id -->
            <button @click="sortById" :class="{active: isColumn('id')}" class="btn btn-sm btn-outline-light text-dark" title="Sort by Id">
              <i class="fa fa-sort-numeric-desc" v-if="isDesc('id')"></i>
              <i class="fa fa-sort-numeric-asc" v-else></i>
            </button>

            <!-- sort by title -->
            <button @click="sortByTitle" :class="{active: isColumn('title')}" class="btn btn-sm btn-outline-light text-dark ml-1" title="Sort by Title">
              <i class="fa fa-sort-alpha-desc" v-if="isDesc('title')"></i>
              <i class="fa fa-sort-alpha-asc" v-else></i>
            </button>

            <!-- sort by favorite -->
            <button @click="sortByFavorite" :class="{active: isColumn('favorite')}" class="btn btn-sm btn-outline-light text-dark ml-1" title="Sort by Favorite state">
              <i class="fa fa-heart" v-if="isDesc('favorite')"></i>
              <i class="fa fa-heart-o" v-else></i>
            </button>

            <!-- reset sorting -->
            <button @click="resetSort" class="btn btn-sm btn-outline-light text-dark ml-3" title="Reset sorting">
              <i class="fa fa-refresh"></i>
            </button>
          </div>

          <div class="float-right">
            <!-- create new item -->
            <button @click="createNote" class="btn btn-sm btn-outline-light text-dark" title="Create new note">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
      
      <!-- notes-list -->
      <ul class="note-list list-group list-group-flush">
        <li v-for="note in note.items" :key="note.id" @click="selectNote(note)" :class="{active: isSelected(note)}" class="list-group-item border-light">
          <span class="d-flex justify-content-between align-items-center">
            {{ note.title }}
            <i class="text-muted fa fa-heart" v-if="note.favorite"></i>
          </span>
          <small class="text-muted">{{ note.updated_at | moment('from', Date(now)) }}</small>
        </li>
      </ul>
    </div>

    <div id="content" class="col-md-9">
      <div class="toolbar border-bottom py-2">
        <!-- editing tools -->
        <div class="container-fluid">
          <div class="input-group input-group-sm mb-3">
            <!-- show only if note is selected -->
            <template v-if="note.selected.id">
              <!-- edit the title -->
              <input v-model="selectedNote.title" type="text" class="form-control rounded-right border-light">

              <!-- mark as favorite -->
              <button @click="toggleFavorite" class="btn btn-sm btn-outline-light text-dark ml-2" title="Mark as favorite">
                <i class="fa fa-heart" v-if="selectedNote.favorite"></i>
                <i class="fa fa-heart-o" v-else></i>
              </button>

              <!-- update the note -->
              <button @click="updateNote" class="btn btn-sm btn-outline-light text-dark ml-2" title="Save note">
                <i class="fa fa-save"></i>
              </button>

              <!-- delete the note -->
              <button @click="deleteNote" class="btn btn-sm btn-outline-light text-dark ml-2" title="Delete note">
                <i class="fa fa-trash-o"></i>
              </button>
            </template>

            <!-- user settings -->
            <div class="dropdown ml-auto">
              <button data-toggle="dropdown" class="dropdown-toggle btn btn-sm btn-outline-light text-dark ml-4" title="Account settings">
                <i class="fa fa-user"></i> {{ user.name }}
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="log-out">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- notepad & preview -->
      <template v-if="note.selected.id">
        <div class="editor row no-gutters">
          <div class="col-md-6 border-right border-light">
            <textarea v-model="selectedNote.body" class="note-pad border-0 p-4" autofocus></textarea>
          </div>
          <div class="col-md-6">
            <div v-html="previewNote" class="markdown-body note-preview p-4"></div>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import lipsum from '../lipsum.json';

export default {
  name: 'app-main',
  
  props: {
    user: {
      type: Object,
      required: true,
    }
  },

  data() {
    return {  
      note: {
        items: this.user.notes || [],
        count: this.user.notes_count || 0,
        
        selected: {
          id: null,
        },
      },
      
      sortBy: {
        type: 'asc',
        column: 'id',
      },

      now: Date.now(),
    }
  },

  computed: {
    selectedNote() {
      return this.note.items.find(note => note.id == this.note.selected.id);
    },

    previewNote() {
      return marked(this.selectedNote.body);
    }
  },

  methods: {
    /**
    ----------------------------------------------------------------------------
     * CRUD operations
    ----------------------------------------------------------------------------
     */
    
    getNotes() {
      //
    },

    createNote() {
      const note = lipsum.items[_.random(0, lipsum.items.length - 1)];
      note.body = atob(note.body);

      axios.post('notes', note)
        .then(response => {
          this.note.items.unshift(response.data.note);
          this.note.count++;
          this.selectNote(this.note.items[0]);

          Push.create('Note created', {
            body: 'Requested item has been created successfully!',
            icon: 'img/icons/fa-check.png',
            timeout: 5000,
            onClick: function () {
              window.focus();
              this.close();
            }
          });
        })
        .catch(error => {
          console.log(error.response);
        });
    },

    updateNote() {
      axios.post('notes/' + this.note.selected.id, this.selectedNote, {
        params: { _method: 'put' }
      })
        .then(response => {
          console.log(response.data);

          this.selectedNote.updated_at = response.data.note.updated_at;

          // Close existing notifications
          Push.close('default');

          Push.create('Note updated', {
            body: 'Requested item has been updated successfully!',
            icon: 'img/icons/fa-check.png',
            timeout: 5000,
            tag: 'default',
            onClick: function () {
              window.focus();
              this.close();
            }
          });
        })
        .catch(error => {
          console.log(error.response);
        });
    },

    deleteNote() {
      axios.delete('notes/' + this.note.selected.id)
        .then(response => {
          console.log(response.data);
          
          const index = this.note.items.indexOf(this.selectedNote);
          if (index !== -1) {
            this.note.items.splice(index, 1);
            this.note.count--;
            this.selectNote(this.note.items[0]);

            // Show success notification to the user
            Push.create('Note deleted', {
              body: 'Requested item has been deleted successfully!',
              icon: 'img/icons/fa-trash-o.png',
              timeout: 5000,
              onClick: function () {
                window.focus();
                this.close();
              }
            });
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    },

    toggleFavorite() {
      this.selectedNote.favorite = !this.selectedNote.favorite;

      axios.post('notes/' + this.note.selected.id, this.selectedNote, {
        params: { _method: 'put' }
      })
        .then(response => {
          console.log(response.data);

          this.selectedNote.updated_at = response.data.note.updated_at;

          // Close existing notifications
          Push.close('default');

          Push.create('Note updated', {
            body: 'Requested item has been updated successfully!',
            icon: 'img/icons/fa-heart.png',
            timeout: 5000,
            tag: 'default',
            onClick: function () {
              window.focus();
              this.close();
            }
          });
        })
        .catch(error => {
          console.log(error.response);
        });
    },


    /**
    ----------------------------------------------------------------------------
     * List Item Selection
    ----------------------------------------------------------------------------
     */

    selectNote(note) {
      this.note.selected.id = note.id;
    },

    isSelected(note) {
      return this.note.selected.id == note.id;
    },


    /**
    ----------------------------------------------------------------------------
     * Item Listing Order
    ----------------------------------------------------------------------------
     */

    sortById() {
      this.toggleSortByType();
      this.sortBy.column = 'id';

      let notes = this.note.items.sort((a, b) => {
        return (this.sortBy.type == 'asc') 
          ? a.id - b.id 
          : b.id - a.id;
      });

      this.note.items = notes;
    },

    sortByTitle() {
      this.toggleSortByType();
      this.sortBy.column = 'title';

      let notes = this.note.items.sort((a, b) => {
        const x = a.title.toLowerCase();
        const y = b.title.toLowerCase();

        return (this.sortBy.type == 'asc')
          ? ((x > y) ? 1 : 0) 
          : ((x < y) ? 1 : 0);
      });

      this.note.items = notes;
    },

    sortByFavorite() {
      this.toggleSortByType();
      this.sortBy.column = 'favorite';
      
      let notes = this.note.items.sort((a, b) => {
        return (this.sortBy.type == 'asc') 
          ? a.favorite - b.favorite 
          : b.favorite - a.favorite;
      });

      this.note.items = notes;
    },

    isColumn(name) {
      return (name == this.sortBy.column);
    },

    isDesc(name) {
      return (this.isColumn(name) && this.sortBy.type == 'desc');
    },

    // This also could be done by calling the 'sortById' method directly.
    // However it has been kept for future code improvements.
    resetSort() {
      this.sortBy.type = 'asc';
      this.sortById();
    },

    toggleSortByType() {
      this.sortBy.type = (this.sortBy.type == 'asc') ? 'desc' : 'asc';
    },


    /**
    ----------------------------------------------------------------------------
     * Other
    ----------------------------------------------------------------------------
     */
    updateNow() {
      this.now = Math.round(Date.now() / 1000);
    }
  },

  created() {
    /**
     * We'll be using the 'sortById' as the default sorting.
     */
    this.sortById();

    /**
     * First, we'll check if 'note.selected.id' is null, then we'll check if 
     * 'note.items' is not null.
     * 
     * Next, we'll assign the id of first note item to 'note.selected.id'.
     */
    if (this.note.selected.id === null && this.note.items !== null) {
      this.note.selected.id = this.note.items[0].id;
    }

    /**
     * We'll update the 'now' property each minute.
     */
    this.updateNow();
    setInterval(this.updateNow.bind(this) , 1000 * 60);
  }
}
</script>
