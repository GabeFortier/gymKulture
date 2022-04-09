document.addEventListener('DOMContentLoaded', function() {
    const loadEl = document.querySelector('#load');
    // // 🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥
    // // The Firebase SDK is initialized and available here!
    //
    // firebase.auth().onAuthStateChanged(user => { });
    // firebase.database().ref('/path/to/ref').on('value', snapshot => { });
    // firebase.firestore().doc('/foo/bar').get().then(() => { });
    // firebase.functions().httpsCallable('yourFunction')().then(() => { });
    // firebase.messaging().requestPermission().then(() => { });
    // firebase.storage().ref('/path/to/ref').getDownloadURL().then(() => { });
    // firebase.analytics(); // call to activate
    // firebase.analytics().logEvent('tutorial_completed');
    // firebase.performance(); // call to activate
    //
    // // 🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥

    try {
      let app = firebase.app();
      let db = firebase.firestore();

      const myCollection = db.collection('testTable');
      const foundDocs = myCollection.where('tag', 'array-contains', 'mens')
      text = "<ul>";
      foundDocs.get().then(snapshot => {
        snapshot.docs.forEach(doc => {
          console.log(doc.data().productName);
          text += "<li>" + doc.data().productName + "</li>";
        })
      })
      text += "</ul>";

      // foundDocs.forEach(doc => {
      //   console.log(doc.id, '=>', doc.data())
      // });
      // foundDocs.get()
      //             .then(doc => {
      //               const data = doc.data();
      //               document.write( data.productName)
      //             });
      // let features = [
      //   'auth', 
      //   'database', 
      //   'firestore',
      //   'functions',
      //   'messaging', 
      //   'storage', 
      //   'analytics', 
      //   'remoteConfig',
      //   'performance',
      // ].filter(feature => typeof app[feature] === 'function');
      // loadEl.textContent = `Firebase SDK loaded with ${features.join(', ')}`;
      console.log(app);
    } catch (e) {
      console.error(e);
      //loadEl.textContent = 'Error loading the Firebase SDK, check the console.';
    }

    
  });