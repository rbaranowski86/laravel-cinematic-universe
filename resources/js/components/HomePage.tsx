import React, {useState, useEffect} from 'react';
import {
    Card,
    CardContent,
    Typography,
    Button,
    Box,
    Dialog,
    DialogActions,
    DialogContent,
    DialogTitle,
    TextField
} from '@mui/material';
import {fetchCinematicUniverses, deleteUniverse, addUniverse, editUniverse} from '../services/UniverseService';
import {CinematicUniverse} from "../types";
import {Link} from "react-router-dom";

const HomePage: React.FC = () => {
    const [universes, setUniverses] = useState<CinematicUniverse[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');
    const [openDialog, setOpenDialog] = useState(false);
    const [editingUniverse, setEditingUniverse] = useState<CinematicUniverse | null>(null);
    const [universeName, setUniverseName] = useState('');
    const [universeDescription, setUniverseDescription] = useState('');
    const [universeFoundationYear, setUniverseFoundationYear] = useState('');


    const loadUniverses = () => {
        setLoading(true);
        fetchCinematicUniverses()
            .then(data => {
                setUniverses(data);
                setLoading(false);
            })
            .catch(err => {
                console.error('Error fetching cinematic universes:', err);
                setError('Failed to load cinematic universes');
                setLoading(false);
            });
    };

    useEffect(() => {
        loadUniverses();
    }, []);

    const handleOpenDialog = (universe: CinematicUniverse | null = null) => {
        setEditingUniverse(universe);
        if (universe) {
            setUniverseName(universe.name);
            setUniverseDescription(universe.description || '');
            setUniverseFoundationYear(universe.foundationYear.toString());
        } else {
            setUniverseName('');
            setUniverseDescription('');
            setUniverseFoundationYear('');
        }
        setOpenDialog(true);
    };

    const handleCloseDialog = () => {
        setOpenDialog(false);
        setEditingUniverse(null);
    };

    const handleSubmit = () => {
        const universeData = {
            name: universeName,
            description: universeDescription,
            foundationYear: universeFoundationYear
        };

        if (editingUniverse) {
            // Edit existing universe
            editUniverse(editingUniverse.id, universeData).then(() => {
                loadUniverses();
                handleCloseDialog();
            }).catch(err => {
                console.error('Error updating universe:', err);
            });
        } else {
            // Add new universe
            addUniverse(universeData).then(() => {
                loadUniverses();
                handleCloseDialog();
            }).catch(err => {
                console.error('Error adding universe:', err);
            });
        }
    };


    const handleDelete = (universeId) => {
        deleteUniverse(universeId)
            .then(() => {
                loadUniverses();
            })
            .catch(err => {
                console.error('Error deleting universe:', err);
            });
    };

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <Box>
            <Button onClick={() => handleOpenDialog()} variant="contained" color="primary">Add Universe</Button>
            {universes.map(universe => (
                <Card key={universe.id} variant="outlined" sx={{marginBottom: 2}}>
                    <CardContent>
                        <Link to={`/universe/${universe.id}`}>
                            <Typography variant="h5" component="h2">
                                {universe.name}
                            </Typography>
                        </Link>
                        <Typography color="textSecondary">
                            {universe.description}
                        </Typography>
                        <Button onClick={() => handleOpenDialog(universe)}>Edit</Button>
                        <Button onClick={() => handleDelete(universe.id)}>Delete</Button>
                    </CardContent>
                </Card>
            ))}

            {/* Dialog for Adding/Editing Universes */}
            <Dialog open={openDialog} onClose={handleCloseDialog}>
                <DialogTitle>{editingUniverse ? 'Edit Universe' : 'Add Universe'}</DialogTitle>
                <DialogContent>
                    <TextField
                        autoFocus
                        margin="dense"
                        label="Name"
                        type="text"
                        fullWidth
                        value={universeName}
                        onChange={(e) => setUniverseName(e.target.value)}
                    />
                    <TextField
                        margin="dense"
                        label="Description"
                        type="text"
                        fullWidth
                        value={universeDescription}
                        onChange={(e) => setUniverseDescription(e.target.value)}
                    />
                    <TextField
                        margin="dense"
                        label="Foundation Year"
                        type="number"
                        fullWidth
                        value={universeFoundationYear}
                        onChange={(e) => setUniverseFoundationYear(e.target.value)}
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseDialog} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleSubmit} color="primary">
                        {editingUniverse ? 'Edit' : 'Add'}
                    </Button>
                </DialogActions>
            </Dialog>
        </Box>
    );
};

export default HomePage;
